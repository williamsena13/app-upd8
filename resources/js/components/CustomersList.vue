<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Clientes</h1>
    </div>
    <div class="table-responsive small">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome Completo</th>
            <th scope="col">CPF</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Sexo</th>
            <th scope="col">Endereço</th>
            <th scope="col">Cidade</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cliente, index) in clientes" :key="cliente.id">
            <td>{{ index + 1 }}</td>
            <td>{{ cliente.nome_completo }}</td>
            <td>{{ cliente.cpf }}</td>
            <td>{{ cliente.data_nascimento }}</td>
            <td>{{ cliente.sexo }}</td>
            <td>{{ cliente.endereco }}</td>
            <td>{{ cliente.cidade }}</td>
            <td>{{ cliente.estado }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div
      class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle"
    >
      <button
        class="btn btn-bd-primary py-2 d-flex align-items-center"
        type="button"
        aria-expanded="false"
        data-bs-toggle="dropdown"
        aria-label="Toggle theme (auto)"
      >
        +
      </button>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      clientes: [], // Array to hold client data
    };
  },
  mounted() {
    console.log("Component mounted.");

    axios.get("/api/clientes").then((response) => {
      console.log("Resposta");
      try {
        console.log(response);
        console.log(response.data);
        if (response.status == 200) {
          console.log(response.data.data.data);
          if (response.data.data.data) {
            this.clientes = response.data.data.data;
          } else {
            this.clientes = response.data.data;
          }
        }
      } catch (error) {
        console.log("Erro");
        console.log(error);
      }
    });
  },
};
</script>
