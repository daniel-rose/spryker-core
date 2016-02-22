<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Cms\Business;

use Generated\Shared\Transfer\CmsBlockTransfer;
use Generated\Shared\Transfer\CmsTemplateTransfer;
use Generated\Shared\Transfer\PageKeyMappingTransfer;
use Generated\Shared\Transfer\PageTransfer;

interface CmsFacadeInterface
{

    /**
     * @param string $name
     * @param string $path
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\TemplateExistsException
     *
     * @return \Generated\Shared\Transfer\CmsTemplateTransfer
     */
    public function createTemplate($name, $path);

    /**
     * @param string $path
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\MissingTemplateException
     *
     * @return \Generated\Shared\Transfer\CmsTemplateTransfer
     */
    public function getTemplate($path);

    /**
     * @param string $path
     *
     * @return bool
     */
    public function hasTemplate($path);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\MissingPageException
     *
     * @return \Generated\Shared\Transfer\PageTransfer
     */
    public function savePage(PageTransfer $pageTransfer);

    /**
     * @param \Generated\Shared\Transfer\CmsBlockTransfer $cmsBlockTransfer
     *
     * @return \Generated\Shared\Transfer\CmsBlockTransfer
     */
    public function saveBlock(CmsBlockTransfer $cmsBlockTransfer);

    /**
     * @param \Generated\Shared\Transfer\PageKeyMappingTransfer $pageKeyMappingTransfer
     *
     * @return \Generated\Shared\Transfer\PageKeyMappingTransfer
     */
    public function savePageKeyMapping(PageKeyMappingTransfer $pageKeyMappingTransfer);

    /**
     * @param \Generated\Shared\Transfer\PageKeyMappingTransfer $pageKeyMappingTransfer
     *
     * @return \Generated\Shared\Transfer\PageKeyMappingTransfer
     */
    public function savePageKeyMappingAndTouch(PageKeyMappingTransfer $pageKeyMappingTransfer);

    /**
     * @param int $idPage
     * @param string $placeholder
     *
     * @return bool
     */
    public function hasPagePlaceholderMapping($idPage, $placeholder);

    /**
     * @param int $idCategory
     *
     * @return bool
     */
    public function hasBlockCategoryNodeMapping($idCategory);

    /**
     * @param int $idPage
     * @param string $placeholder
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\MissingGlossaryKeyMappingException
     *
     * @return \Generated\Shared\Transfer\PageKeyMappingTransfer
     */
    public function getPagePlaceholderMapping($idPage, $placeholder);

    /**
     * @param \Generated\Shared\Transfer\CmsTemplateTransfer $cmsTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\CmsTemplateTransfer
     */
    public function saveTemplate(CmsTemplateTransfer $cmsTemplateTransfer);

    /**
     * @param int $idPage
     * @param string $placeholder
     * @param array $data
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\MissingGlossaryKeyMappingException
     * @throws \Spryker\Zed\Glossary\Business\Exception\MissingTranslationException
     *
     * @return string
     */
    public function translatePlaceholder($idPage, $placeholder, array $data = []);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     * @param string $placeholder
     * @param string $value
     *
     * @return \Generated\Shared\Transfer\PageKeyMappingTransfer
     */
    public function addPlaceholderText(PageTransfer $pageTransfer, $placeholder, $value);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     * @param string $placeholder
     *
     * @throws \Spryker\Zed\Cms\Business\Exception\MissingGlossaryKeyMappingException
     * @throws \Exception
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return bool
     */
    public function deletePageKeyMapping(PageTransfer $pageTransfer, $placeholder);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     * @param string $url
     *
     * @throws \Spryker\Zed\Url\Business\Exception\UrlExistsException
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    public function createPageUrl(PageTransfer $pageTransfer, $url);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     *
     * @return void
     */
    public function touchPageActive(PageTransfer $pageTransfer);

    /**
     * @param \Generated\Shared\Transfer\CmsBlockTransfer $cmsBlockTransfer
     *
     * @return void
     */
    public function touchBlockActive(CmsBlockTransfer $cmsBlockTransfer);

    /**
     * @param \Generated\Shared\Transfer\CmsBlockTransfer $cmsBlockTransfer
     *
     * @return void
     */
    public function touchBlockDelete(CmsBlockTransfer $cmsBlockTransfer);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     * @param string $url
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    public function savePageUrlAndTouch(PageTransfer $pageTransfer, $url);

    /**
     * @param \Generated\Shared\Transfer\PageTransfer $pageTransfer
     * @param \Generated\Shared\Transfer\CmsBlockTransfer $blockTransfer
     *
     * @return \Generated\Shared\Transfer\PageTransfer
     */
    public function savePageBlockAndTouch(PageTransfer $pageTransfer, CmsBlockTransfer $blockTransfer);

    /**
     * @param int $idPage
     *
     * @return bool
     */
    public function deleteGlossaryKeysByIdPage($idPage);

    /**
     * @param string $cmsTemplateFolderPath
     *
     * @return bool
     */
    public function syncTemplate($cmsTemplateFolderPath);

    /**
     * @param string $templateName
     * @param string $placeholder
     *
     * @return string
     */
    public function generateGlossaryKeyName($templateName, $placeholder);

    /**
     * @param int $idCategoryNode
     *
     * @return void
     */
    public function updateBlocksAssignedToDeletedCategoryNode($idCategoryNode);

    /**
     * @param int $idCategoryNode
     *
     * @return \Generated\Shared\Transfer\CmsBlockTransfer[]
     */
    public function getCmsBlocksByIdCategoryNode($idCategoryNode);

}