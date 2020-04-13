<?php

declare(strict_types=1);


namespace Percas\Core\Component\Grid\Action;


class EditAction extends AbstractAction
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'edit';
    }
}
