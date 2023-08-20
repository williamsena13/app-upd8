<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Clientes</h1>
    </div>
    <form @submit.prevent="cadastrarCliente" class="row">
      <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
          <label for="nomeCompleto" class="form-label">Nome Completo</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="nomeCompleto"
            v-model="formData.nomeCompleto"
            required
          />
        </div>

        <div class="col-auto">
          <label for="cpf" class="form-label">CPF</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="cpf"
            v-model="formData.cpf"
            required
          />
        </div>

        <div class="col-auto">
          <label for="dataNascimento" class="form-label"
            >Data de Nascimento</label
          >
        </div>
        <div class="col-auto">
          <input
            type="date"
            class="form-control"
            id="dataNascimento"
            v-model="formData.dataNascimento"
            required
          />
        </div>

        <div class="col-auto">
          <label class="form-label">Sexo: </label>
        </div>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="sexo"
              id="sexoM"
              value="M"
              v-model="formData.sexo"
              required
            />
            <label class="form-check-label" for="sexoM">Masculino</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="sexo"
              id="sexoF"
              value="F"
              v-model="formData.sexo"
              required
            />
            <label class="form-check-label" for="sexoF">Feminino</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="sexo"
              id="sexoO"
              value="O"
              v-model="formData.sexo"
              required
            />
            <label class="form-check-label" for="sexoO">Outro</label>
          </div>
        </div>
      </div>

      <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
          <label for="endereco" class="form-label">Endereço</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="endereco"
            v-model="formData.endereco"
            required
          />
        </div>

        <div class="col-auto">
          <label for="cidade" class="form-label">Cidade</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="cidade"
            v-model="formData.cidade"
            required
          />
        </div>

        <div class="col-auto">
          <label for="estado" class="form-label">Estado</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="estado"
            v-model="formData.estado"
            required
          />
        </div>
      </div>

      <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-light" @click="limparCampos">
            Limpar
          </button>
        </div>
      </div>

      <!-- Exibir mensagens de erro -->
      <div v-if="errors.length" class="alert alert-danger">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>
    </form>
  </main>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        cpf: "",
        nomeCompleto: "",
        dataNascimento: "",
        sexo: "M",
        endereco: "",
        cidade: "",
        estado: "",
      },
      errors: [], // Array para armazenar mensagens de erro
    };
  },
  methods: {
    cadastrarCliente() {
      console.log("cadastrar");
      axios
        .post("/api/clientes", this.formData)
        .then((response) => {
          console.log("Cliente cadastrado com sucesso!");
          // Lógica para fechar o modal e atualizar a lista de clientes
        })
        .catch((error) => {
          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {
            this.errors = Object.values(error.response.data.errors).flat();
          } else {
            console.error("Erro ao cadastrar cliente:");
            console.log(error);
          }
        });
    },
    limparCampos() {
      // Limpar os campos do formulário
      this.formData.cpf = "";
      this.formData.nomeCompleto = "";
      this.formData.dataNascimento = "";
      this.formData.sexo = "M";
      this.formData.endereco = "";
      this.formData.cidade = "";
      this.formData.estado = "";
      this.errors = [];
    },
  },
};
</script>

<style scoped>
/* Estilos se necessário */
</style>
