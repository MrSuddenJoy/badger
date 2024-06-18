import { Component } from "vue-property-decorator";
import Decorator from './decorator.vue';

@Component
export default class WikiDecorator extends Decorator {
  // @ts-expect-error
  text = this.item.title;
}
