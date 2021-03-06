/**
 * Copyright (c) 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

require('ZedGui');

$(document).ready( function () {
    var onCategoryTemplateSelectChange = function ($item) {
        var idCategoryTemplate = $item.val();

        if (!idCategoryTemplate) {
            $("select[id^='category_id_cms_blocks_']").each(function (key, selectCmsBlock) {
                $(selectCmsBlock).prev('label').hide();
                $(selectCmsBlock).next('.select2-container').hide();
            });

            return;
        }

        var nameCategoryTemplate = $item.find('option[value='+ idCategoryTemplate +']').html();

        $("select[id^='category_id_cms_blocks_']").each(function (key, item) {
            var assignedCmsBlocks = $(item).data('assigned-cms-blocks');
            var supportedTemplates = $(item).data('supported-templates');

            if ($.inArray(nameCategoryTemplate, supportedTemplates) >= 0) {
                $(item).prev('label').show();
                $(item).next('.select2-container').show();
            } else {
                $(item).prev('label').hide();
                $(item).next('.select2-container').hide();
            }

            if (assignedCmsBlocks && assignedCmsBlocks[idCategoryTemplate]) {
                $(item).val(assignedCmsBlocks[idCategoryTemplate]);
            } else {
                $(item).val([]);
            }

            $(item).trigger('change');
        });
    };

    var $categoryTemplateSelect = $('[name=category\\[fk_category_template\\]]');

    $categoryTemplateSelect.on('change', function() {
        onCategoryTemplateSelectChange($(this));
    });

    onCategoryTemplateSelectChange($categoryTemplateSelect);

});
