package main

import (
	"fmt"
	"log"
	"net/http"

	"github.com/google/go-github/v39/github"
	"golang.org/x/oauth2"
)

func main() {
	// Configura o roteamento para diferentes endpoints
	http.HandleFunc("/github", handleGitHub)
	http.HandleFunc("/azure", handleAzure)

	// Inicia o servidor na porta 8080
	fmt.Println("Server is running on localhost:8080")
	log.Fatal(http.ListenAndServe(":8080", nil))
}

func handleGitHub(w http.ResponseWriter, r *http.Request) {
	// Crie um cliente de autenticação OAuth2 para a API do GitHub
	token := "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"
	ts := oauth2.StaticTokenSource(
		&oauth2.Token{AccessToken: token},
	)
	tc := oauth2.NewClient(r.Context(), ts)

	// Crie um cliente da API do GitHub
	client := github.NewClient(tc)

	// Exemplo de operação da API do GitHub - listar repositórios do usuário
	repos, _, err := client.Repositories.List(r.Context(), "", nil)
	if err != nil {
		http.Error(w, "Failed to list GitHub repositories", http.StatusInternalServerError)
		return
	}

	// Escreva a resposta na página
	fmt.Fprintf(w, "https://github.com/NSCINC/perseu-v1")
	for _, repo := range repos {
		fmt.Fprintf(w, "%s\n", repo.GetName())
	}
}

func handleAzure(w http.ResponseWriter, r *http.Request) {
	// Aqui você pode adicionar a lógica para interagir com a API da Azure
	fmt.Fprintf(w, "Interacted with Azure successfully")
}
