<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Touch\Business\Model\BulkTouch\Filter;

class IdFilterInsert extends AbstractIdFilter
{
    const CHUNK_SIZE = 250;

    /**
     * @param array $ids
     * @param string $itemType
     *
     * @return array
     */
    public function filter(array $ids, $itemType)
    {
        $filteredIds = [];
        $itemIdChunks = array_chunk($ids, self::CHUNK_SIZE);
        foreach ($itemIdChunks as $itemIdChunk) {
            $idCollection = $this->getIdCollection($itemType, $itemIdChunk);

            $filteredIds = array_merge($filteredIds, array_diff($itemIdChunk, $idCollection));
        }

        return $filteredIds;
    }
}
