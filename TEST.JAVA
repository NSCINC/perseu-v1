public class AuthenticatorTest {
    
    public static void main(String[] args) {
        testAuthenticateUser();
    }

    private static void testAuthenticateUser() {
        String username = "testUser";
        String correctPassword = "correctPassword";
        String incorrectPassword = "incorrectPassword";

        // Crie uma instância do Authenticator
        Authenticator authenticator = new Authenticator();

        // Cenário 1: Usuário e senha corretos
        boolean result1 = authenticator.authenticateUser(username, correctPassword);
        System.out.println("Test Result 1 (Correct Credentials): " + (result1 ? "Passed" : "Failed"));

        // Cenário 2: Usuário correto, senha incorreta
        boolean result2 = authenticator.authenticateUser(username, incorrectPassword);
        System.out.println("Test Result 2 (Incorrect Password): " + (!result2 ? "Passed" : "Failed"));

        // Cenário 3: Usuário incorreto, senha correta
        boolean result3 = authenticator.authenticateUser("nonexistentUser", correctPassword);
        System.out.println("Test Result 3 (Incorrect Username): " + (!result3 ? "Passed" : "Failed"));

        // Cenário 4: Usuário e senha incorretos
        boolean result4 = authenticator.authenticateUser("nonexistentUser", "wrongPassword");
        System.out.println("Test Result 4 (Incorrect Credentials): " + (!result4 ? "Passed" : "Failed"));
    }
}
