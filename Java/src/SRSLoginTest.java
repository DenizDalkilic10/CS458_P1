import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.annotations.*;

import java.io.FileInputStream;
import java.io.IOException;

public class SRSLoginTest {
    ChromeDriver driver;
    WebElement username_element,password_element,login_button;

    @BeforeClass
    public void Initialize() {
        System.setProperty("webdriver.chrome.driver", "C:\\Users\\user\\Desktop\\Web_Drivers\\chromedriver.exe");
        driver = new ChromeDriver();
        driver.get("http://localhost/Php/index.php");

        username_element = driver.findElement(By.xpath("//input[@name='LoginForm_username']"));
        password_element = driver.findElement(By.xpath("//input[@name='LoginForm_password']"));
        login_button = driver.findElement(By.xpath("//button[@name='login']"));
    }

    @AfterMethod
    public void Terminate() throws IOException {
        driver.navigate().to(driver.getCurrentUrl());
    }

    @DataProvider(name = "invalidPasswordDataProvider")
    public static Object[][] invalidPasswordTestDataProvider() {

        return new Object[5][2];
    }

    @Test
    public void invalidPasswordTest() {
        username_element.sendKeys("1234");
        password_element.sendKeys("1234");
        login_button.click();
    }

    @DataProvider(name = "invalidUsernameDataProvider")
    public static Object[] invalidUsernameTestDataProvider() {
        return new Object[5][2];
    }

    @Test(dataProvider = "invalidUsernameDataProvider")
    public void invalidUsernameTest(String username, String password) {

    }

    @DataProvider(name = "invalidAllCredentialsDataProvider")
    public static Object[] invalidAllCredentialsTestDataProvider() {
        return new Object[5][2];
    }

    @Test(dataProvider = "invalidAllCredentialsDataProvider")
    public void invalidAllCredentialsTest(String username, String password) {

    }

    @DataProvider(name = "successfulLoginDataProvider")
    public static Object[] successfulLoginTestDataProvider() {
        return new Object[5][2];
    }

    @Test(dataProvider = "successfulLoginDataProvider")
    public void successfulLoginTest(String username, String password) {

    }

    @DataProvider(name = "pageRefreshDataProvider")
    public static Object[] pageRefreshTestDataProvider() {
        return new Object[5][2];
    }

    @Test(dataProvider = "pageRefreshDataProvider")
    public void pageRefreshTest(String username, String password) {

    }

    boolean performLoginOperation(String username, String password) {
        return false;
    }
}
