import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testng.keyword.TestNGBuiltinKeywords as TestNGKW
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable
import org.openqa.selenium.Keys as Keys
import com.kms.katalon.core.util.KeywordUtil as KeywordUtil
import com.artlens.utils.AdminUtils as AdminUtils

try {
	WebUI.callTestCase(findTestCase('admin/landing_page/header_bar_visible'), [:], FailureHandling.STOP_ON_FAILURE)
	
	AdminUtils.adminLogin(GlobalVariable.ValidUsernameCredentials[0], GlobalVariable.ValidPasswordCredentials[0])
	
	String currentUrl = WebUI.getUrl()
	
	String expectedUrl = "${GlobalVariable.appBaseLink}adminindex.php"

	boolean isUrlCorrect = WebUI.verifyMatch(currentUrl, expectedUrl, false)

	if (isUrlCorrect) {
		KeywordUtil.markPassed('The URL is correct: ' + currentUrl)
	} else {
		KeywordUtil.markFailed((('The URL is incorrect. Expected: ' + expectedUrl) + ' but got: ') + currentUrl)
	}
	
}
catch (Exception e) {
	KeywordUtil.markFailed('An error occurred: ' + e.message)
}
finally {
	WebUI.closeBrowser()
}

