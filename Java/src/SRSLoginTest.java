import com.google.gson.*;
import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.Assert;
import org.testng.annotations.*;

import java.io.FileInputStream;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;

public class SRSLoginTest {
    ChromeDriver driver;
    WebElement username_element, password_element, login_button, label;

    @BeforeClass
    public void Initialize() {
        System.setProperty("webdriver.chrome.driver", "C:\\Users\\user\\Desktop\\Web_Drivers\\chromedriver.exe");
        driver = new ChromeDriver();
        driver.get("http://localhost/Php/index.php");
    }

    @AfterMethod
    public void Terminate() throws IOException {
        driver.navigate().to(driver.getCurrentUrl());
    }

    @BeforeMethod
    public void BeforeMethod() throws IOException {
        username_element = driver.findElement(By.xpath("//input[@name='LoginForm_username']"));
        password_element = driver.findElement(By.xpath("//input[@name='LoginForm_password']"));
        login_button = driver.findElement(By.xpath("//button[@name='login']"));
    }

    @DataProvider(name = "failedLoginDataProvider")
    public static Object[] failedLoginTestDataProvider() throws IOException {
        String data = readFile("Resources/testDataInputs.json");
        return readCredentialsFromResource(data, "Test1");
    }

    @Test(dataProvider = "failedLoginDataProvider")
    public void failedLoginTest(String username, String password, String expectedResult) {

        performLoginOperation(username, password, expectedResult);
    }

    @Test
    public void forgotPasswordTest(String username, String password, String expectedResult) {
        //TODO FORGOT PASSWORD LINKE TIKLAYINCA BIR LABEL CIKMASI LAZIM
    }

    @DataProvider(name = "successfulLoginDataProvider")
    public static Object[] successfulLoginTestDataProvider() throws IOException {
        String data = readFile("Resources/testDataInputs.json");
        return readCredentialsFromResource(data, "Test2");
    }

    @Test(dataProvider = "successfulLoginDataProvider")
    public void successfulLoginTest(String username, String password, String expectedResult) {
        performLoginOperation(username, password, expectedResult);
    }

    @DataProvider(name = "pageRefreshDataProvider")
    public static Object[] pageRefreshTestDataProvider() {
        return new Object[][]{{"210345", "Mypassword", "Failed Login"}};
    }

    @Test(dataProvider = "pageRefreshDataProvider")
    public void pageRefreshTest(String username, String password, String expectedResult) {
        performLoginOperation(username, password, expectedResult);
        performRefreshOperation();
    }

    @DataProvider(name = "passwordPasteDataProvider")
    public static Object[] passwordPasteTestDataProvider() {
        return new Object[][]{{"Copy paste is not allowed for password"}};
    }

    @Test(dataProvider = "passwordPasteDataProvider")
    public void passwordPasteTest(String expectedResult) {
        performCopyPasteOperation(expectedResult);
    }


    ////METHODS////
    
    void performLoginOperation(String username, String password, String expectedResult) {
        username_element.sendKeys(username);
        password_element.sendKeys(password);
        login_button.click();
        label = driver.findElement(By.xpath("//p[@class='help-block']//span[@class='Message']"));
        String outcome = label.getText();
        Assert.assertEquals(outcome, expectedResult);
    }

    void performRefreshOperation() {
        driver.navigate().refresh(); //refreshing the page
        label = driver.findElement(By.xpath("//p[@class='help-block']//span[@class='Message']"));
        String outcome = label.getText();
        Assert.assertEquals(outcome, "");
    }

    void performCopyPasteOperation(String expectedResult) {
        password_element.sendKeys("Mypassword1");
        password_element.sendKeys(Keys.chord(Keys.CONTROL, "a"));
        password_element.sendKeys(Keys.chord(Keys.CONTROL, "c"));
        password_element.sendKeys(Keys.chord(Keys.CONTROL, "v"));
        label = driver.findElement(By.xpath("//p[@class='help-block']//span[@class='Message']"));
        String outcome = label.getText();
        Assert.assertEquals(outcome, expectedResult);
    }

    public static Object[][] readCredentialsFromResource(String json, String testName) {
        JsonObject jsonFile = new JsonParser().parse(json).getAsJsonObject();
        JsonArray testJson = jsonFile.getAsJsonArray(testName);
        Object[][] testData = new Object[testJson.size()][3];

        for (int i = 0; i < testJson.size(); i++) {
            JsonObject obj = testJson.get(i).getAsJsonObject();
            testData[i][0] = obj.get("userID").getAsString();
            testData[i][1] = obj.get("password").getAsString();
            testData[i][2] = obj.get("output").getAsString();
        }
        return testData;
    }

    public static String readFile(String fileName) throws IOException {
        String data = new String(Files.readAllBytes(Paths.get(fileName)));
        return data;
    }

}
