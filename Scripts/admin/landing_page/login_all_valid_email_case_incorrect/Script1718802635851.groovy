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
import java.util.Random


try {
	
	Number userIndex = GlobalVariable.userIndex
	
	WebUI.callTestCase(findTestCase('admin/landing_page/header_bar_visible'), [:], FailureHandling.STOP_ON_FAILURE)
	
	String email = GlobalVariable.ValidUsernameCredentials[userIndex]

	// Split the email into username and domain parts
	String[] parts = email.split('@')
	String usernamePart = parts[0]
	String domainPart = parts[1]
	
	// Check current case of usernamePart and invert it
	if (Character.isUpperCase(usernamePart.charAt(0))) {
	    // Convert to lowercase if currently uppercase
	    usernamePart = usernamePart.toLowerCase()
	} else {
	    // Convert to uppercase if currently lowercase
	    usernamePart = usernamePart.toUpperCase()
	}
	
	// Reassemble the modified email
	String modifiedEmail = usernamePart + '@' + domainPart
	
	// Log the modified email
	KeywordUtil.logInfo("Modified Email: " + modifiedEmail)
	
	// Get the password from ValidPasswordCredentials[0]
	String password = GlobalVariable.ValidPasswordCredentials[userIndex]
	
	// Perform admin login using the modified email and password
	AdminUtils.adminLogin(modifiedEmail, password)
	
	String currentUrl = WebUI.getUrl()
	
	String expectedUrl = "${GlobalVariable.appBaseLink}admin.php"

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
//	WebUI.closeBrowser()
}

