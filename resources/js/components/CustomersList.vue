<template>
  <div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Clientes</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button
            type="button"
            class="btn btn-sm btn-outline-secondary"
            @click="callAlert()"
          >
            Exportar
          </button>
        </div>
        <router-link type="button" class="btn btn-success" to="/clientes/novo">
          Adicionar
        </router-link>
      </div>
    </div>
    <FiltrosClientes />
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
              <router-link
                :to="'/clientes/editar/' + cliente.id"
                class="btn btn-sm btn-success"
                >Editar</router-link
              >
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

    <nav class="text-center">
      <ul class="pagination">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a
            class="page-link"
            href="#"
            tabindex="-1"
            aria-disabled="true"
            @click="changePage(currentPage - 1)"
            >Anterior</a
          >
        </li>
        <li
          class="page-item"
          v-for="page in totalPages"
          :key="page"
          :class="{ active: currentPage === page }"
        >
          <a class="page-link" href="#" @click="changePage(page)">{{ page }}</a>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <a class="page-link" href="#" @click="changePage(currentPage + 1)"
            >Próximo</a
          >
        </li>
      </ul>
    </nav>

    <div
      class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle"
    >
      <router-link type="button" class="btn btn-primary" to="/clientes/novo">
        Adicionar
      </router-link>
    </div>
  </div>
</template>

<script>
import FiltrosClientes from "./CustomersFilter.vue";

export default {
  inject: ["eventBus"],

  data() {
    return {
      clientes: [],
      param: [],
      currentPage: 1,
      totalPages: 1,
    };
  },
  components: {
    FiltrosClientes,
  },
  mounted() {
    this.eventBus.on("search-customer-list", (param) => {
      this.param = param;
      this.buscarClientes();
    });
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
      const params = { ...this.param, page: this.currentPage };

      this.$http.get("/clientes", { params }).then((response) => {
        try {
          console.log("RETORNO");
          console.log(response);
          if (response.status === 200) {
            if (response.data.data.data) {
              this.clientes = response.data.data.data;
            } else {
              this.clientes = response.data.data;
            }
            this.totalPages = response.data.data.last_page;
          }
        } catch (error) {
          console.log("Erro");
          console.log(error);
        }
      });
    },
    excluirCliente(id) {
      if (confirm("Tem certeza de que deseja excluir este cliente?")) {
        this.$http
          .delete(`/clientes/${id}`)
          .then((response) => {
            this.buscarClientes();
          })
          .catch((error) => {
            console.error("Erro ao excluir o cliente:", error);
          });
      }
    },
    callAlert() {
      this.$http.get("/export-pdf").then((response) => {
        const blob = new Blob([response.data], { type: "application/pdf" });
        const link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = "clientes.pdf";
        link.click();
      });
    },
    changePage(pageNumber) {
      if (pageNumber > 0 && pageNumber <= this.totalPages) {
        this.currentPage = pageNumber;
        this.buscarClientes();
      }
    },
  },
};
</script>
