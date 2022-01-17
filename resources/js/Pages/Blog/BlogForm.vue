<template>
  <div class="grid grid-cols-1 justify-center gap-4" :class="isSEOVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
    <form class="sm:shadow sm:p-5" :class="isSEOVisible ? 'col-span-2' : 'col-span-3'">
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3 mb-6">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Titolo
          </label>
          <input class="appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
            placeholder="Titolo del post"
            :class="{'border-red-500': checking, 'border-gray-200': !checking}"
            v-model.trim="data.title">
          <p v-if="checking" class="text-red-500 text-xs italic">Please fill out this field.</p>
        </div>
        <div class="w-full px-3 mb-6">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Sottotitolo
          </label>
          <input class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
            placeholder="Sottotitolo del post"
            v-model.trim="data.subtitle">
            <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
        </div>
        <div class="w-full px-3 mb-6 md:mb-7">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Preview
          </label>
          <SummernoteEditor :config="previewConf" v-model="data.preview" />
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Testo
          </label>
          <SummernoteEditor :config="textConf" v-model="data.text"/>
        </div>
      </div>
    </form> <!-- /form -->
    <form class="sm:shadow sm:p-5 -mx-3">
      <div class="w-full px-3 mb-6">
        <label class="block tracking-wide uppercase text-gray-700 text-xs font-bold mb-2">
          Immagine di copertina
        </label>
        <input v-if="!data.page.cover_id" type="file" accept="image/*">
      </div>
      <div class="w-full px-3 mb-6">
        <label class="block tracking-wide uppercase text-gray-700 text-xs font-bold mb-2">
          Gallery
        </label>
        <input v-if="!data.gallery_id" type="file" accept="image/*">
      </div>
      <button
        v-if="!data.page.approved_at"
        class="text-blue-600 hover:text-blue-500 px-4 mb-3 block"
        @click="data.page.approved_at = currentDateTime()">
        Programma pubblicazione
      </button>
      <div v-else class="w-full px-3 mb-6">
        <label class="block tracking-wide uppercase text-gray-700 text-xs font-bold mb-2">
          Pubblicazione
        </label>
        <input
          class="appearance-none w-11/12 inline bg-gray-50 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
          :class="[data.page.approved_at ? 'text-gray-700' : 'text-gray-400']"
          type="datetime-local"
          :value="data.page.approved_at || currentDateTime()"
          @focus="data.page.approved_at = !data.page.approved_at ? currentDateTime() : data.page.approved_at"
          @change="ev => data.page.approved_at = ev.target.value">
        <button @click.prevent="data.page.approved_at = null" class="w-1/12 align-middle text-5xl text-right inline-block">&times;</button>
        <label v-if="!data.page.expires_at && data.page.approved_at" class="cursor-pointer">
          <input
            type="checkbox"
            class="mt-3 scale-150 mr-2 cursor-pointer"
            :checked="!data.page.expires_at"
            @change="data.page.expires_at = true">
          Senza scadenza
        </label>
        <div v-else-if="data.page.expires_at && data.page.approved_at" class="mt-6">
          <label class="block tracking-wide uppercase text-gray-700 text-xs font-bold mb-2">
            Scadenza
          </label>
          <input
            class="appearance-none w-11/12 inline bg-gray-50 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            :class="data.page.expires_at === true ? 'text-gray-400' : 'text-gray-700'"
            type="datetime-local"
            :value="data.page.expires_at || currentDateTime()"
            @change="ev => data.page.expires_at = ev.target.value">
          <button @click.prevent="data.page.expires_at = null" class="w-1/12 align-middle text-5xl text-right inline-block">&times;</button>
        </div>
      </div>
      <div v-if="isSEOVisible" class="flex flex-wrap mb-6">
        <div class="w-full px-3 mb-6">
          <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ '<title>...</title>' }}
          </label>
          <input class="appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
            :placeholder="data.title"
            :class="{'border-red-500': checking, 'border-gray-200': !checking}"
            v-model.trim="data.page.title">
          <p v-if="checking" class="text-red-500 text-xs italic">Please fill out this field.</p>
        </div>
        <div class="w-full px-3 mb-6">
          <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ '<h1>...</h1>' }}
          </label>
          <input class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
            :placeholder="data.title"
            v-model.trim="data.page.header_1">
        </div>
        <div class="w-full px-3 mb-6">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Slug
          </label>
          <div class="flex flex-wrap items-baseline">
            <div class="text-ellipsis whitespace-nowrap overflow-x-hidden lg:max-w-[50%]">
              <span class="text-gray-500">{{ $page.props.host }}</span>
              <span v-if="data.page.parent_slug" class="text-gray-500">/{{ data.page.parent_slug }}</span>
            </div>
            <span class="text-gray-500">/</span>
            <input class="appearance-none flex-1 lg:min-w-0 bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              type="text"
              :placeholder="slugify(data.title)"
              @input="ev => data.page.slug = slugify(ev.target.value)"
              :value="data.page.slug">
          </div>
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ '<meta name="description" content="...">' }}
          </label>
          <textarea cols="30" rows="5" class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            v-model.trim="data.page.description"
            :placeholder="stripHtml(data.preview) || stripHtml(data.text)"></textarea>
        </div>
        <div class="w-full px-3 mb-6">
          <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ '<meta property="og:title" content="...">' }}
          </label>
          <input class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            type="text"
            :placeholder="data.title"
            v-model.trim="data.page.og_title">
        </div>
        <div class="w-full px-3 mb-6 md:mb-3">
          <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ '<meta propery="og:description" content="...">' }}
          </label>
          <textarea cols="30" rows="5" class="appearance-none block w-full bg-gray-50 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            v-model.trim="data.page.og_description"
            :placeholder="stripHtml(data.preview) || stripHtml(data.text)"></textarea>
        </div>
      </div>
      <button @click.prevent="isSEOVisible = !isSEOVisible"
        class="text-blue-600 hover:text-blue-500 px-4 block">{{ isSEOVisible ? 'Nascondi SEO' : 'Modifica SEO' }}</button>
    </form> <!-- /form -->
  </div>
</template>

<script>
import { slugify, stripHtml } from '../../utils'
import { ref } from 'vue'
import 'summernote/dist/summernote-lite.js'
import 'summernote/dist/summernote-lite.css'
import '@/br.summernote.js'
import 'summernote/dist/lang/summernote-it-IT.js'
import SummernoteEditor from 'vue3-summernote-editor'

const currentDateTime = () => {
  const d = new Date()
  d.setMinutes(d.getMinutes() - d.getTimezoneOffset())
  return d.toISOString().slice(0, 16)
}

export default {
  props: ['data'],
  components: { SummernoteEditor },
  data() {
    return {
      isSEOVisible: false,
      previewConf: {
        toolbar: [
          ['font', ['bold', 'underline', 'strikethrough', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['table', 'link']],
          ['view', ['codeview']],
          ['undo', ['undo', 'redo']],
        ],
        minHeight: 70,
        lang: "it-IT"
      },
      textConf: {
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'strikethrough', 'clear']],
          ['fontname', ['fontname']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['table','picture', 'video', 'link', 'hr']],
          ['view', ['codeview']],
          ['undo', ['undo', 'redo']],
          ['extra', ['fullscreen']]
        ],
        minHeight: 250,
        lang: "it-IT",
        styleTags: [
          { title: 'Paragrafo', tag: 'p', value: 'p' },
          { title: 'Citazione', tag: 'blockquote', value: 'blockquote' },
          { title: 'Codice', tag: 'pre', value: 'pre' },
          { title: 'H2', tag: 'h2', value: 'h2' },
          { title: 'H3', tag: 'h3', value: 'h3' },
          { title: 'H4', tag: 'h4', value: 'h4' },
          { title: 'H5', tag: 'h5', value: 'h5' },
          { title: 'H6', tag: 'h6', value: 'h6' },
        ]
      }
    }
  },
  setup() {
    const checking = ref(false)
    return {
      slugify,
      stripHtml,
      currentDateTime,
      checking
    }
  }
}
</script>