<template>
  <div>
    <h1 class="h5">Consultar Cliente por:</h1>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="cpf" class="form-label">CPF</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="cpf"
            v-model="cpf"
            required
          />
        </div>

        <div class="col-auto">
          <label for="nome_completo" class="form-label">Nome Completo</label>
        </div>
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            id="nome_completo"
            v-model="nome_completo"
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
            v-model="data_nascimento"
            required
          />
        </div>

        <div class="col-auto">
          <label class="form-label">Sexo:</label>
        </div>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="sexo"
              id="sexoM"
              value="M"
              v-model="sexo"
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
              v-model="sexo"
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
              v-model="sexo"
              required
            />
            <label class="form-check-label" for="sexoO">Outro</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="sexo"
              id="sexoT"
              value="T"
              v-model="sexo"
              required
            />
            <label class="form-check-label" for="sexoT">Todos</label>
          </div>
        </div>
      </div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="estado" class="form-label">Estado:</label>
        </div>
        <div class="col-auto">
          <select
            class="form-select"
            id="estado"
            v-model="selectedState"
            @change="loadCities"
          >
            <option value="" disabled>Selecionar estado</option>
            <option
              v-for="state in states"
              :key="state.sigla"
              :value="state.sigla"
            >
              {{ state.nome }}
            </option>
          </select>
        </div>

        <div class="col-auto">
          <label for="cidade" class="form-label">Cidade:</label>
        </div>
        <div class="col-auto">
          <select class="form-select" id="cidade" v-model="cidade">
            <option value="" disabled>Filtrar por Cidade</option>
            <option v-for="city in cities" :key="city" :value="city">
              {{ city }}
            </option>
          </select>
        </div>

        <div class="col-auto d-flex justify-content-end">
          <button class="btn btn-secondary me-2" @click="clearFilters">
            Limpar
          </button>
          <button class="btn btn-primary" @click="filtrarClientes">
            Pesquisar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {
  name: "FiltrosClientes",
  data() {
    return {
      cpf: "",
      nome_completo: "",
      data_nascimento: "",
      sexo: "",
      cidade: "",
      selectedState: "",
      states: [],
      cities: [],
    };
  },
  methods: {
    async loadStates() {
      try {
        const response = await this.$http.get(
          "https://servicodados.ibge.gov.br/api/v1/localidades/estados"
        );
        this.states = response.data;
      } catch (error) {
        console.error("Error loading states:", error);
      }
    },
    async loadCities() {
      if (this.selectedState) {
        try {
          const response = await this.$http.get(
            `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${this.selectedState}/municipios`
          );
          this.cities = response.data.map((city) => city.nome);
        } catch (error) {
          console.error("Error loading cities:", error);
        }
      } else {
        this.cities = [];
      }
    },
    clearFilters() {
      this.cpf = "";
      this.nome_completo = "";
      this.data_nascimento = "";
      this.sexo = "";
      this.cidade = "";
      this.selectedState = "";
      this.cities = [];
    },
    filtrarClientes() {},
  },
  mounted() {
    this.loadStates();
  },
};
</script>
  
  <style scoped>
/* Add any additional styling here */
</style>
  