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
    public function tryToTest(AcceptanceTester $I)
    {
		$I->amOnPage('/');
		$I->waitForElementVisible('#id_common_login', 60);
		
		$I->fillField('loginUsername', 'admin');
		$I->fillField('loginPassword', 'password');
		$I->click('#id_common_login');

		$I->waitForElementVisible('#ChangePWCheckBox', 60);
		$I->checkOption('#ChangePWCheckBox');
		$I->click('Apply');

		$I->waitForElementVisible('#modem_border', 30);
		$I->click('#modem_border');

		$I->waitForText('Configuration', 30);
		$I->waitForElementVisible('#id_reboot', 30);
		$I->click('#id_reboot');

    }
}
