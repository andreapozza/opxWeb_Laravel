<template>
  <div class="grid grid-cols-1 justify-center gap-4" :class="isSEOVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
    <form class="sm:p-5" :class="isSEOVisible ? 'col-span-2' : 'col-span-3'">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 mb-6">
          <InputText
            label="Titolo"
            placeholder="Titolo del post"
            v-model:value="data.title"
          />
        </div>
        <div class="w-full px-3 mb-6">
          <InputText
            label="Sottotitolo"
            placeholder="Sottotitolo del post"
            v-model:value="data.subtitle"
          />
        </div>
        <div class="w-full px-3 mb-6 md:mb-7">
          <Label>Preview</Label>
          <SummernoteEditor :config="previewConf" v-model="data.preview" />
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <Label>Testo</Label>
          <SummernoteEditor :config="textConf" v-model="data.text" />
        </div>
      </div>
    </form>
    <!-- /form -->
    <form class="shadow bg-white sm:p-5 rounded-lg -mx-3">
      <div class="w-full px-3 mb-6">
        <Label>Immagine di copertina</Label>
        <div class="bg-white border rounded p-2 max-w-[185px]">
          <div class="bg-neutral-300 overflow-hidden block m-auto">

            <!--// TODO: modificare immagine placeholder -->

            <img v-if="data.page.cover_id" class="object-cover aspect-square w-full h-full" :src="data.page.cover_id">
            <div v-else class="w-full aspect-square object-cover grid">
              <font-awesome-icon :icon="['fas', 'image']" class="text-7xl m-auto"/>
            </div>
            
          </div>
          <button @click.prevent="showImageUploader = true" class="mt-2 w-full justify-center text-ellipsis whitespace-nowrap text-xs bg-slate-600 hover:bg-slate-700 rounded-md px-4 py-2 font-bold shadow text-white inline-flex items-center">Cambia immagine</button>
        </div>
      </div>
      <div class="w-full px-3 mb-6">
        <Label>Gallery</Label>
        <input v-if="!data.gallery_id" type="file" accept="image/*" />
      </div>
      <button
        v-if="!data.page.approved_at"
        class="text-blue-600 hover:text-blue-500 px-4 mb-3 block"
        @click="data.page.approved_at = currentDateTime()"
      >
        Programma pubblicazione
      </button>
      <div v-else class="w-full px-3 mb-6">
        <Label>Pubblicazione</Label>
        <input
          class="appearance-none w-11/12 inline bg-gray-50 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          :class="[data.page.approved_at ? 'text-gray-700' : 'text-gray-400']"
          type="datetime-local"
          :value="getDateTime(data.page.approved_at) || currentDateTime()"
          @focus="data.page.approved_at = !data.page.approved_at ? currentDateTime() : getDateTime(data.page.approved_at)"
          @change="(ev) => (data.page.approved_at = ev.target.value)"
        />
        <button
          @click.prevent="data.page.approved_at = null"
          class="w-1/12 align-middle text-5xl text-right inline-block"
        >
          &times;
        </button>
        <label
          v-if="!data.page.expires_at && data.page.approved_at"
          class="cursor-pointer"
        >
          <input
            type="checkbox"
            class="mt-3 scale-150 mr-2 cursor-pointer"
            :checked="!data.page.expires_at"
            @change="data.page.expires_at = true"
          />
          Senza scadenza
        </label>
        <div v-else-if="data.page.expires_at && data.page.approved_at" class="mt-6">
          <Label>Scadenza</Label>
          <input
            class="appearance-none w-11/12 inline bg-gray-50 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            :class="data.page.expires_at === true ? 'text-gray-400' : 'text-gray-700'"
            type="datetime-local"
            :value="getDateTime(data.page.expires_at) || getDateTime(data.page.approved_at)"
            :min="getDateTime(data.page.approved_at)"
            @change="(ev) => (data.page.expires_at = ev.target.value)"
          />
          <button @click.prevent="data.page.expires_at = null" class="w-1/12 align-middle text-5xl text-right inline-block">
            &times;
          </button>
        </div>
      </div>
      <div v-if="isSEOVisible" class="flex flex-wrap mb-6">
        <div class="w-full px-3 mb-6">
          <Label :uppercase="false">{{ '<title>...</title>' }}</Label>
          <InputText
            :placeholder="data.title"
            v-model:value="data.page.title"
            />
        </div>
        <div class="w-full px-3 mb-6">
          <Label :uppercase="false">{{ '<h1>...</h1>' }}</Label>
          <InputText
            :placeholder="data.title"
            v-model:value="data.page.header_1"
            />
        </div>
        <div class="w-full px-3 mb-6">
          <InputSlug
            label="Slug"
            :placeholder="data.title"
            v-model:value="data.page.slug">
            <template #prepend>
              <span>{{ $page.props.host }}</span>
              <span v-if="data.page.parent_slug">/{{ data.page.parent_slug }}</span>
            </template>
          </InputSlug>
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <Label :uppercase="false">
            {{ '<meta name="description" content="..." />' }}
          </Label>
          <Textarea
            v-model:value="data.page.description"
            :placeholder="stripHtml(data.preview) || stripHtml(data.text)"
          ></Textarea>
        </div>
        <div class="w-full px-3 mb-6">
          <Label :uppercase="false">
            {{ '<meta property="og:title" content="..." />' }}
          </Label>
          <InputText
            :placeholder="data.title"
            v-model:value="data.page.og_title"
            />
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <Label :uppercase="false">
            {{ '<meta propery="og:description" content="..." />' }}
          </Label>
          <Textarea
            v-model:value="data.page.og_description"
            :placeholder="stripHtml(data.preview) || stripHtml(data.text)"
          ></Textarea>
        </div>
      </div>
      <button @click.prevent="isSEOVisible = !isSEOVisible" class="text-blue-600 hover:text-blue-500 px-4 block">
        {{ isSEOVisible ? "Nascondi SEO" : "Modifica SEO" }}
      </button>
    </form>
    <!-- /form -->
  </div>

  <Modal :show="showImageUploader" @close="showImageUploader = false" >
    <div class="p-4 min-h-[80vh]">
      ciao
    </div>
  </Modal>


</template>

<script setup>
import { stripHtml } from "@/utils";
import { computed, ref } from "vue";
import "summernote/dist/summernote-lite.js";
import "summernote/dist/summernote-lite.css";
import "@/br.summernote.js";
import "summernote/dist/lang/summernote-it-IT.js";
import { SummernoteEditor, InputSlug, InputText, Label, Textarea } from '@/Components/Form/FormComponents'
import Modal from '@/Jetstream/Modal.vue'

const showImageUploader = ref(false)

const isChecking = ref(false);

const currentDateTime = () => {
  const d = new Date();
  d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
  return d.toISOString().slice(0, 16);
};

const getDateTime = (string) => {
  if (!string || string === true) return null;
  const d = new Date(string);
  d.setMinutes(d.getMinutes() - d.getTimezoneOffset());
  return d.toISOString().slice(0, 16);
};

const props = defineProps({
  data: {}
})

const isSEOVisible = ref(false)
const previewConf = computed(() => ({
  toolbar: [
    ["font", ["bold", "underline", "strikethrough", "clear"]],
    ["fontname", ["fontname"]],
    ["color", ["color"]],
    ["para", ["ul", "ol", "paragraph"]],
    ["insert", ["table", "link"]],
    ["view", ["codeview"]],
    ["undo", ["undo", "redo"]],
  ],
  minHeight: 70,
  lang: "it-IT",
  disableDragAndDrop: !showImageUploader.value
}))

const textConf = computed(() => ({
  toolbar: [
    ["style", ["style"]],
    ["font", ["bold", "underline", "strikethrough", "clear"]],
    ["fontname", ["fontname"]],
    ["color", ["color"]],
    ["para", ["ul", "ol", "paragraph"]],
    ["insert", ["table", "picture", "video", "link", "hr"]],
    ["view", ["codeview"]],
    ["undo", ["undo", "redo"]],
    ["extra", ["fullscreen"]],
  ],
  minHeight: 250,
  lang: "it-IT",
  styleTags: [
    { title: "Paragrafo", tag: "p", value: "p" },
    { title: "Citazione", tag: "blockquote", value: "blockquote" },
    { title: "Codice", tag: "pre", value: "pre" },
    { title: "H2", tag: "h2", value: "h2" },
    { title: "H3", tag: "h3", value: "h3" },
    { title: "H4", tag: "h4", value: "h4" },
    { title: "H5", tag: "h5", value: "h5" },
    { title: "H6", tag: "h6", value: "h6" },
  ],
  disableDragAndDrop: !showImageUploader.value
}))

</script>