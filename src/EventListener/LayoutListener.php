<?php

namespace Derhaeuptling\CombinerUtilityBundle\EventListener;

use Contao\BackendUser;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;

#[AsHook('getPageLayout')]
class LayoutListener
{
    private TokenChecker $tokenChecker;

    public function __construct(TokenChecker $tokenChecker)
    {
        $this->tokenChecker = $tokenChecker;
    }

    public function __invoke(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        if (($user = $this->getBackendUser()) !== null && $user->disableCombineScripts) {
            $layout->combineScripts = false;
        }
    }

    private function getBackendUser(): ?BackendUser
    {
        $user = BackendUser::getInstance();
        $hasBackendUser = $this->tokenChecker->hasBackendUser();

        return $hasBackendUser ? $user : null;
    }
}
