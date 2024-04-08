<template>
  <div class="flex justify-end">
        <button v-if="data.current_page > 1" @click="$emit('byPageNo')"
          class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-slate-700 border-transparent bg-transparent text-center align-middle font-bold uppercase text-slate-700 transition-all hover:opacity-75">
          <span class="text-xl mb-1 mr-0.5">‹</span>
        </button>
        <!-- page links creation -->
        <template v-for="(link, index) of data.links" :key="index">
          <button v-if="link.label >= 1 && link.label <= data.last_page"  @click="$emit('byPageNo', link.label)"
            class="leading-pro ease-soft-in bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid  border-transparent bg-transparent text-center align-middle font-bold uppercase  transition-all "
            :class="[link.active ? 'border-lime-500 cursor-not-allowed' : 'border-slate-700 hover:opacity-75']"
            :disabled="link.active">
            <span class="text-sm mr-0.5">{{ link.label }}</span>
          </button>
        </template>
        <!-- end page links creation -->
        <button v-if="data.current_page < data.last_page" @click="$emit('byPageNo', data.last_page)"
          class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-slate-700 border-transparent bg-transparent text-center align-middle font-bold uppercase  transition-all hover:opacity-75">
          <span class="text-xl mb-1 mr-0.5">›</span>
        </button>
      </div>
</template>

<script setup>
const props = defineProps(['data']);

</script>
