package com.artlens.utils

import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject

import com.kms.katalon.core.annotation.Keyword
import com.kms.katalon.core.checkpoint.Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling
import com.kms.katalon.core.testcase.TestCase
import com.kms.katalon.core.testdata.TestData
import com.kms.katalon.core.testobject.TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows

import internal.GlobalVariable

@FunctionalInterface
public interface Callback {
	void execute();
}

public class AdminUtils extends CommonUtils {

	@Keyword
	public static void adminLogin(String username, String password) {
		adminLogin(username, password, null);
	}

	@Keyword
	public static void adminLogin(String username, String password, Callback callback) {

		WebUI.click(findTestObject('Object Repository/admin/landing_page/a_Admin Login'))

		// Verify that the Admin Login link is present and visible
		WebUI.verifyElementPresent(findTestObject('Object Repository/admin/landing_page/a_Admin Login'), 0)
		WebUI.verifyElementVisible(findTestObject('Object Repository/admin/landing_page/a_Admin Login'), FailureHandling.STOP_ON_FAILURE)

		if (username != null) {
			WebUI.setText(findTestObject('Object Repository/admin/landing_page/input_ARTLENS_uname'), username)
		} else {
			WebUI.clearText(findTestObject('Object Repository/admin/landing_page/input_ARTLENS_uname'))
		}

		// Click the Show button to reveal the password input field
		WebUI.click(findTestObject('Object Repository/admin/landing_page/button_Show'))

		if (password != null) {
			WebUI.setText(findTestObject('Object Repository/admin/landing_page/input_ARTLENS_pass_1'), password)
		} else {
			WebUI.clearText(findTestObject('Object Repository/admin/landing_page/input_ARTLENS_pass_1'))
		}

		if (callback != null) {
			callback.execute();
		}

		// Verify that the Login button is present and visible
		WebUI.verifyElementPresent(findTestObject('Object Repository/admin/landing_page/button_Login'), 0)
		WebUI.verifyElementVisible(findTestObject('Object Repository/admin/landing_page/button_Login'), FailureHandling.STOP_ON_FAILURE)

		WebUI.click(findTestObject('Object Repository/admin/landing_page/button_Login'))
	}
}
