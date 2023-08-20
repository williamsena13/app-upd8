<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Clientes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button
            type="button"
            class="btn btn-sm btn-outline-secondary"
            disabled
          >
            Exportar
          </button>
        </div>
        <router-link type="button" class="btn btn-success" to="/clientes/novo">
          Adicionar
        </router-link>
      </div>
    </div>
    <div class="table-responsive small">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th scope="col">Nome Completo</th>
            <th scope="col">CPF</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Sexo</th>
            <th scope="col">Endereço</th>
            <th class="text-center" scope="col">Cidade</th>
            <th class="text-center" scope="col">Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cliente in clientes" :key="cliente.id">
            <td>
              <button class="btn btn-sm btn-success">Editar</button>
            </td>
            <td>
              <button
                class="btn btn-sm btn-danger"
                @click="excluirCliente(cliente.id)"
              >
                Excluir
              </button>
            </td>
            <td>{{ cliente.nome_completo }}</td>
            <td>{{ cliente.cpf }}</td>
            <td class="text-center">
              {{ formatarDataLocal(cliente.data_nascimento) }}
            </td>
            <td>{{ getSexoLabel(cliente.sexo) }}</td>
            <td>{{ cliente.endereco }}</td>
            <td class="text-center">{{ cliente.cidade }}</td>
            <td class="text-center">{{ cliente.estado }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div
      class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle"
    >
      <router-link type="button" class="btn btn-primary" to="/clientes/novo">
        Adicionar
      </router-link>
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
    this.buscarClientes();
  },
  methods: {
    chamarModal() {},
    getSexoLabel(sexo) {
      switch (sexo) {
        case "M":
          return "Masculino";
        case "F":
          return "Feminino";
        case "O":
          return "Outro";
        default:
          return "Desconhecido";
      }
    },
    formatarDataLocal(data) {
      const dataObj = new Date(data);
      const dia = String(dataObj.getDate()).padStart(2, "0");
      const mes = String(dataObj.getMonth() + 1).padStart(2, "0"); // Os meses começam em 0 no objeto Date
      const ano = dataObj.getFullYear();
      return `${dia}/${mes}/${ano}`;
    },
    buscarClientes() {
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
    excluirCliente(id) {
      if (confirm("Tem certeza de que deseja excluir este cliente?")) {
        axios
          .delete(`/api/clientes/${id}`)
          .then((response) => {
            if (response.status === 204) {
              // Cliente excluído com sucesso, atualize a lista de clientes
              this.clientes = this.clientes.filter(
                (cliente) => cliente.id !== id
              );
            }

            this.buscarClientes();
          })
          .catch((error) => {
            console.error("Erro ao excluir o cliente:", error);
          });
      }
    },
  },
};
</script>
