<?php

namespace Derhaeuptling\CombinerUtilityBundle\EventListener;

use Contao\BackendUser;
use Contao\LayoutModel;
use Contao\PageModel;

class LayoutListener
{
    /**
     * On get the page layout
     *
     * @param PageModel   $page
     * @param LayoutModel $layout
     */
    public function onGetPageLayout(PageModel $page, LayoutModel $layout): void
    {
        if (($user = $this->getBackendUser()) !== null && $user->disableCombineScripts) {
            $layout->combineScripts = '';
        }
    }

    /**
     * Get the backend user
     *
     * @return BackendUser|null
     */
    private function getBackendUser(): ?BackendUser
    {
        $user = BackendUser::getInstance();

        // Contao 4.5+
        if (version_compare(VERSION, '4.5', '>=')) {
            return ($user instanceof BackendUser) ? $user : null;
        }

        return $user->authenticate() ? $user : null;
    }
}
