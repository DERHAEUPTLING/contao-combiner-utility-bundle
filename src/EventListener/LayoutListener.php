<?php

namespace Derhaeuptling\CombinerUtilityBundle\EventListener;

use Contao\BackendUser;
use Contao\CoreBundle\Exception\RedirectResponseException;
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

        // Contao 4.4 will redirect to the login page if user is not authenticated
        try {
            $authenticated = $user->authenticate();
        } catch (RedirectResponseException $e) {
            return null;
        }

        return $authenticated ? $user : null;
    }
}
