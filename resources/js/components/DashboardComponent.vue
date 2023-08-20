<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Home</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button
          type="button"
          class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1"
        >
          Sair
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="card text-center bg-primary text-white">
          <div class="card-header">Clientes</div>
          <div class="card-body">
            <h5 class="card-title">Nº Clientes</h5>
            <p class="card-text">
              Existem <strong>{{ getCountClientes }}</strong> clientes
              cadastrados
            </p>
          </div>
          <div class="card-footer">
            <router-link class="text-white" to="/clientes">Ver</router-link>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      numeroClientes: 0,
    };
  },
  mounted() {
    this.buscarClientes();
  },
  computed: {
    getCountClientes() {
      return this.numeroClientes;
    },
  },
  methods: {
    async buscarClientes() {
      try {
        console.log("Vou buscar!");
        await axios
          .get("api/countCustomers") // Altere a URL para a rota correta
          .then((response) => {
            console.log(response);
            console.log(response.status);
            if (response.status === 200) {
              this.numeroClientes = response.data.data;
            }
          })
          .catch((error) => {
            console.error("Erro ao buscar clientes:", error);
          });
      } catch (error) {
        console.error("Erro ao buscar número de clientes:", error);
      }
    },
  },
};
</script>
