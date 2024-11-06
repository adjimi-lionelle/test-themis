// src/shims-vue.d.ts
import Vue from "vue";

declare module "vue/types/vue" {
  interface Vue {
   // $emit: (event: string, ...args: unknown[]) => void;

  }
}
