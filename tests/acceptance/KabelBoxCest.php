<?php

class KabelBoxCest
{

	// private function waitForUrl(string $url, int $timeout){
	// 	$this->getModule('WebDriver')
	// 		->waitForJs('return location.href.indexOf("' . $url . '") !== -1;', $timeout);
	// }

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function restartTheRouter(AcceptanceTester $I)
    {
		$I->amOnPage('/');
		$I->waitForElementVisible('#id_common_login', 60);
		
		$I->fillField('loginUsername', 'admin');
		$I->fillField('loginPassword', 'password');
		$I->click('#id_common_login');

		$I->waitForElementVisible('#ChangePWCheckBox', 60);
		$I->checkOption('#ChangePWCheckBox');
		$I->click('Apply');

		$I->switchToIframe('#iframebasefrm');

		try {
			$I->dontSee('Please wait a few moments');
		} catch (Exception $e) {
			$I->wait(60);//First admin page request, router is slow 
			$I->reloadPage();
			$I->waitForElementVisible('#iframebasefrm');
			$I->switchToIframe('#iframebasefrm');
		}

		$I->waitForText('Enabled', 30, '#id_common_enable');//Wifi Status: Enabled
		$I->waitForElementVisible('#modem_border', 30);
		$I->click('#modem_border');
		$I->switchToIframe();//back to main

		$I->switchToIframe('#iframeMenu');
		$I->waitForElementVisible('#idmenunodeconfiguration', 30);//==Configuration link

		$I->clickWithLeftButton('#idmenunodeconfiguration');
		$I->switchToIframe();//back to main
		
		$I->switchToIframe('#iframebasefrm');
		try{
			$I->waitForElementVisible('#id_reboot', 30);
		} catch (Exception $e) {
			//try to click again, so as to refresh
			$I->switchToIframe();//back to main
			$I->switchToIframe('#iframeMenu');
			$I->clickWithLeftButton('#idmenunodeconfiguration');
			$I->switchToIframe();//back to main
			$I->switchToIframe('#iframebasefrm');
		}
		$I->clickWithLeftButton('#id_reboot');

		$I->wait(5);//wait for ajax calls
		$I->see('Rebooting System');
		$I->makeScreenshot('proof_before_closing');

		$I->wait(30);//wait for ajax calls
		$I->switchToIframe();//back to main
		$I->click('Logout');//in case it just does nothing
		$I->wait(1);

		$I->makeScreenshot('the_end');
    }
}
