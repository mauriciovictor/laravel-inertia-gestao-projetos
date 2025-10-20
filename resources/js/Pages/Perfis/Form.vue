<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { Form, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const props = defineProps(['perfil', 'features'])

//carrega os dados pra atualização
const form = useForm({
  name: props.perfil?.name ?? '',
  permissions: props.perfil?.permissions ?? [],
})

const submitAction = props.perfil?.id ? route('roles.update', props.perfil.id) : route('roles.store')
</script>
 <template>
     <AppLayout>
    <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-gray-100">
      <div class="flex items-start justify-between mb-6">
        <div>
          <h3 class="text-2xl font-semibold text-gray-800">{{ props.perfil ? 'Editar Perfil' : 'Cadastro de Perfil' }}</h3>
          <p class="text-sm text-gray-500 mt-1">Defina o nome do perfil e selecione as permissões por feature.</p>
        </div>
      </div>

      <Form :action="submitAction" :method="props.perfil?.id ? 'put' : 'post'" #default="{ errors }" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <label class="flex flex-col">
            <span class="text-sm font-medium text-gray-700 mb-2">Nome do Perfil</span>
            <div class="flex items-center gap-3 bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 focus-within:ring-2 focus-within:ring-emerald-200">
              <i class="pi pi-id-badge text-gray-400"></i>
              <InputText name="name" v-model="form.name" placeholder="Nome do perfil" class="w-full bg-transparent border-0 focus:ring-0"/>
            </div>
            <Message v-if="errors.name" severity="error" size="small" variant="simple">{{ errors.name }}</Message>
          </label>
        </div>

        <div class="space-y-3">
          <h4 class="text-lg font-medium text-gray-800">Permissões</h4>
          <p class="text-sm text-gray-500">Selecione as permissões agrupadas por feature.</p>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div v-for="feature in features" :key="feature.key" class="p-4 bg-gray-50 rounded-lg border border-gray-200">
              <div class="flex items-center justify-between mb-3">
                <div class="font-semibold text-gray-700">{{ feature.label }}</div>
                <!-- selecionar todos da feature -->
                <button type="button" class="text-sm text-emerald-600 hover:underline" @click="() => {
                  // selecionar todos os keys da feature (se já todos selecionados remove)
                  const keys = feature.permissions.map(p => p.key)
                  const allSelected = keys.every(k => form.permissions.includes(k))
                  if (allSelected) {
                    form.permissions = form.permissions.filter(p => !keys.includes(p))
                  } else {
                    // adicionar aqueles que ainda não existem
                    form.permissions = Array.from(new Set([...form.permissions, ...keys]))
                  }
                }">
                  Toggle todos
                </button>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <label v-for="perm in feature.permissions" :key="perm.key" class="flex items-center gap-2">
                  <input type="checkbox" :value="perm.key" v-model="form.permissions" name="permissions[]" class="w-4 h-4 text-emerald-600 rounded"/>
                  <span class="text-sm text-gray-700">{{ perm.label }}</span>
                </label>
              </div>
            </div>
          </div>

          <Message v-if="errors.permissions" severity="error" size="small" variant="simple">{{ errors.permissions }}</Message>
        </div>

        <div class="flex items-center justify-end gap-3">
          <Link :href="route('roles.index')" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 bg-white hover:bg-gray-50 text-sm text-gray-700">
            <i class="pi pi-chevron-left"></i>
            Voltar
          </Link>

          <Button
            type="submit"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-lg text-white shadow-md transform hover:-translate-y-0.5 transition"
            style="background: linear-gradient(90deg,#10b981,#06b6d4);"
            icon="pi pi-check"
            label="Salvar"
          />
        </div>
      </Form>
    </div>
  </AppLayout>
</template>
