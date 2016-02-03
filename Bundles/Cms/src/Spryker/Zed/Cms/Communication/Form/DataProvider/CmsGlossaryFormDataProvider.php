<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Cms\Communication\Form\DataProvider;

use Spryker\Zed\Cms\Communication\Form\CmsGlossaryForm;
use Spryker\Zed\Cms\Persistence\CmsQueryContainer;

class CmsGlossaryFormDataProvider
{

    /**
     * @var \Spryker\Zed\Cms\Persistence\CmsQueryContainer
     */
    protected $cmsQueryContainer;

    /**
     * @param \Spryker\Zed\Cms\Persistence\CmsQueryContainer $cmsQueryContainer
     */
    public function __construct(CmsQueryContainer $cmsQueryContainer)
    {
        $this->cmsQueryContainer = $cmsQueryContainer;
    }

    /**
     * @param int $idPage
     * @param int|null $idMapping
     * @param string|null $placeholder
     *
     * @return array
     */
    public function getData($idPage, $idMapping = null, $placeholder = null)
    {
        $formItems = [
            CmsGlossaryForm::FIELD_FK_PAGE => $idPage,
            CmsGlossaryForm::FIELD_ID_KEY_MAPPING => $idMapping,
        ];

        if ($placeholder !== null) {
            $formItems[CmsGlossaryForm::FIELD_PLACEHOLDER] = $placeholder;
        }

        if ($idMapping !== null) {
            $glossaryMapping = $this
                ->cmsQueryContainer
                ->queryGlossaryKeyMappingWithKeyById($idMapping)
                ->findOne();

            if ($glossaryMapping) {
                $formItems[CmsGlossaryForm::FIELD_PLACEHOLDER] = $glossaryMapping->getPlaceholder();
                $formItems[CmsGlossaryForm::FIELD_GLOSSARY_KEY] = $glossaryMapping->getKeyname();
                $formItems[CmsGlossaryForm::FIELD_TRANSLATION] = $glossaryMapping->getTrans();
            }
        }

        return $formItems;
    }

}