import { Component, Vue, Prop } from "vue-property-decorator";

@Component
export default class DecoratorMixin extends Vue {
  @Prop()
  value!: String;

  @Prop()
  item!: Object;

  protected highlight(text) {
    // @ts-expect-error
    if (!this.value) {
      return text;
    }

    // @ts-expect-error
    const value = this.value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

    const ascii = value.normalize('NFD').replace(/[\u0300-\u036f]/gu, "");
    const re = new RegExp(`\\b(${value}|${ascii})`, "i");

    return text.replace(re, "<strong>$1</strong>");
  }


}
