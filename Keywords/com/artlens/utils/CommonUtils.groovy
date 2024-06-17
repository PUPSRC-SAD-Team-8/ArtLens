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

public class CommonUtils {
	/**
	 * Opens a web page if the link is accessible.
	 *
	 * This method constructs the full URL using the base link and the provided page name.
	 * It verifies if the constructed URL is accessible. If the URL is accessible, it navigates to the URL.
	 * Otherwise, it logs a comment indicating that the URL is not accessible.
	 *
	 * @param pageName the name of the page to be opened (appended to the base link)
	 */
	static void openWebPage(String pageName) {
	    String fullUrl = "${GlobalVariable.appBaseLink}${pageName}"
	    boolean isAccessible = WebUI.verifyLinksAccessible([fullUrl])
	    
	    // Navigate to the URL only if it is accessible
	    if (isAccessible) {
	        WebUI.navigateToUrl(fullUrl)
	    } else {
	        WebUI.comment("The URL ${fullUrl} is not accessible.")
	    }
	}

}
