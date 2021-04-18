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
		} catch (\Exception $e) {
			echo 'ERROR: Router too slow ' . $e->getMessage() . PHP_EOL;

			$I->wait(60);//First admin page request, router is slow 
			$I->reloadPage();
			$I->waitForElementVisible('#iframebasefrm');
			$I->switchToIframe('#iframebasefrm');
		}

		//$I->waitForText('Good', 30, '#id_status_moden_text1');//Modem Status: Good
		$I->waitForElementVisible('#modem_border', 30);
		
		$I->amOnPage('/common_page/RgConfig.html');
		$I->reloadPage();
		$I->waitForElementVisible('#id_reboot', 30);
		$I->clickWithLeftButton('#id_reboot');

		$I->wait(15);//wait for ajax calls
		$I->see('Rebooting System');
		//$I->makeScreenshot('proof_before_closing' . date('Y-m-d H:i:s'));

		$I->amOnPage('index.html');
		$I->waitForElementVisible('#id_common_logout');
		$I->clickWithLeftButton('Logout');//in case it just does nothing
		$I->wait(5);

		$I->makeScreenshot('the_end' . date('Y-m-d H:i:s'));
    }
}
