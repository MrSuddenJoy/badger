// import axios from 'axios';
import Vue from 'vue';
import VueFollowButton from '@/components/forms/follow-button';

let tooltipTimer;
let vm;

function removeVCard() {
  const vcard = document.getElementById('vcard');

  if (vcard) {
    vm.$destroy();
    vcard.remove();
  }
}

function showVCard(event) {
  clearTimeout(tooltipTimer);

  const el = event.target;
  const userId = el.dataset.userId;

  const handler = () => {
    axios.get(`/User/Vcard/${userId}`).then(result => {
      removeVCard();

      const container = document.createElement('div');
      container.innerHTML = `<div>${result.data}<div>`

      document.getElementsByTagName('body')[0].appendChild(container);

      vm = new Vue({ el: '#vcard', components: { 'vue-follow-button': VueFollowButton } });

      const vcard = document.getElementById('vcard');

      vcard.style.top = `${event.pageY + 10}px`;
      vcard.style.left = `${Math.min(event.pageX + 10, window.innerWidth - 450)}px`;

      vcard.addEventListener('mouseenter', () => clearTimeout(tooltipTimer));
      vcard.addEventListener('mouseleave', removeVCard);
    });
  };

  tooltipTimer = setTimeout(handler, 800);
}

function hideVCard() {
  clearTimeout(tooltipTimer);

  tooltipTimer = setTimeout(removeVCard, 1500);
}

function bindEvents() {
  const links = document.querySelectorAll('a[data-user-id]');

  links.forEach(link => {
    link.addEventListener('mouseenter', showVCard);
    link.addEventListener('mouseleave', hideVCard);
  });
}

new MutationObserver(bindEvents).observe(document.body, { attributes: true, childList: true, subtree: true });
