<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Clientes</h1>
    </div>
    <form @submit.prevent="gravarCliente" class="row">
      <div class="row g-3 align-items-center mb-3">
        <div class="col-auto">
          <label for="nome_completo" class="form-label">Nome Completo</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="nome_completo"
            v-model="formData.nome_completo"
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
          <label for="data_nascimento" class="form-label"
            >Data de Nascimento</label
          >
        </div>
        <div class="col-auto">
          <input
            type="date"
            class="form-control"
            id="data_nascimento"
            v-model="formData.data_nascimento"
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
            class="form-control text-uppercase"
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
          <button
            type="button"
            class="btn btn-light"
            @click="limparCampos"
            v-if="!isEditing"
          >
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
      isEditing: false,
      formData: {
        cpf: "",
        nome_completo: "",
        data_nascimento: "",
        sexo: "M",
        endereco: "",
        cidade: "",
        estado: "",
      },
      errors: [], // Array para armazenar mensagens de erro
    };
  },
  methods: {
    gravarCliente() {
      console.log("cadastrar");
      if (this.isEditing === true) {
        this.editarCliente();
      } else {
        this.cadastrarCliente();
      }
    },
    cadastrarCliente() {
      this.$http
        .post("/clientes", this.formData)
        .then((response) => {
          console.log("Cliente cadastrado com sucesso!");
          if (response.status === 200) {
            this.$router.push({ name: "customer.index" });
          }
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
    editarCliente() {
      const clientId = this.$route.params.id;
      console.log(this.formData);
      this.$http
        .put(`/clientes/${clientId}`, this.formData)
        .then((response) => {
          console.log("Cliente editado com sucesso!");
          if (response.status === 200) {
            this.$router.push({ name: "customer.index" });
          }
        })
        .catch((error) => {
          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {
            this.errors = Object.values(error.response.data.errors).flat();
          } else {
            console.error("Erro ao editar cliente:");
            console.log(error);
          }
        });
    },
    buscarCliente(clientId) {
      this.$http
        .get(`/clientes/${clientId}`)
        .then((response) => {
          const clientData = response.data; // Assuming the API response structure matches your client data structure
          if (response.status === 200) {
            console.log("Vou popular com:");
            console.log(response.data.data);
            this.popularCampos(response.data.data);
          }
        })
        .catch((error) => {
          console.error("Error fetching client data:", error);
        });
    },

    limparCampos() {
      // Limpar os campos do formulário
      this.formData.cpf = "";
      this.formData.nome_completo = "";
      this.formData.data_nascimento = "";
      this.formData.sexo = "M";
      this.formData.endereco = "";
      this.formData.cidade = "";
      this.formData.estado = "";
      this.errors = [];
    },
    popularCampos(clientData) {
      if (clientData === null) {
        this.limparCampos();
        return;
      }

      this.formData.cpf = clientData.cpf;
      this.formData.nome_completo = clientData.nome_completo;
      this.formData.data_nascimento = clientData.data_nascimento;
      this.formData.sexo = clientData.sexo;
      this.formData.endereco = clientData.endereco;
      this.formData.cidade = clientData.cidade;
      this.formData.estado = clientData.estado.toUpperCase();
      this.errors = [];
    },
  },
  mounted() {
    const clientId = this.$route.params.id; // Get the client ID from the route parameters
    if (clientId) {
      this.isEditing = true;
      this.buscarCliente(clientId);
    }
  },
};
</script>

<style scoped>
/* Estilos se necessário */
</style>
