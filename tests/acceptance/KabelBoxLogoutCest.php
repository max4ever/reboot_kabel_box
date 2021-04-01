<?php

class KabelBoxLogoutCest
{

    // tests
    public function quit(AcceptanceTester $I)
    {
		$I->amOnPage('/');
		
		$I->waitForText('Logout');
		$I->click('Logout');
		$I->wait(1);

		$I->makeScreenshot('the_end' . date('Y-m-d H:i:s'));
    }
}
