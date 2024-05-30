// Configurações do Firebase (substitua pelos seus próprios valores)
const firebaseConfig = {
  apiKey: "SUA_API_KEY",
  authDomain: "SEU_DOMÍNIO.firebaseapp.com",
  projectId: "SEU_ID_DO_PROJETO",
  storageBucket: "SEU_STORAGE_BUCKET",
  messagingSenderId: "SEU_ID_DO_SENDER",
  appId: "SEU_APP_ID"
};

// Inicialize o Firebase
firebase.initializeApp(firebaseConfig);

// Função para autenticar com e-mail e senha
function signInWithEmailAndPassword(email, password) {
  firebase.auth().signInWithEmailAndPassword(email, password)
    .then((userCredential) => {
      // Autenticação bem-sucedida
      const user = userCredential.user;
      console.log('Usuário autenticado:', user);
    })
    .catch((error) => {
      // Trate os erros de autenticação aqui
      const errorCode = error.code;
      const errorMessage = error.message;
      console.error('Erro de autenticação:', errorCode, errorMessage);
    });
}

// Exemplo de uso da função signInWithEmailAndPassword
const email = 'example@example.com';
const password = 'senha123';
signInWithEmailAndPassword(email, password);
