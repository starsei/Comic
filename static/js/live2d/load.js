// ==UserScript==
// @name                #相亲相爱一嘉人#
// @description         在哔站右下角添加嘉然小姐的live2d模型
// @version             1.0.1
// @namespace           https://github.com/journey-ad
// @author              journey-ad
// @include             /^https:\/\/(www|live|space|t)\.bilibili\.com\/.*$/
// @icon                https://www.google.com/s2/favicons?domain=bilibili.com
// @license             GPL v2
// @run-at              document-end
// @grant               none
// ==/UserScript==
(async function () {
    'use strict';
  
    if (inIframe()) {
      console.log('iframe中不加载');
      return false;
    }
  
    const 引流 = [
      "https://space.bilibili.com/672328094",
      "https://www.bilibili.com/video/BV1FZ4y1F7HH",
      "https://www.bilibili.com/video/BV1FX4y1g7u8",
      "https://www.bilibili.com/video/BV1aK4y1P7Cg",
      "https://www.bilibili.com/video/BV17A411V7Uh",
      "https://www.bilibili.com/video/BV1JV411b7Pc",
      "https://www.bilibili.com/video/BV1AV411v7er",
      "https://www.bilibili.com/video/BV1564y1173Q",
  
      "https://www.bilibili.com/video/BV1MX4y1N75X",
      "https://www.bilibili.com/video/BV17h411U71w",
      "https://www.bilibili.com/video/BV1ry4y1Y71t",
      "https://www.bilibili.com/video/BV1Sy4y1n7c4",
      "https://www.bilibili.com/video/BV15y4y177uk",
      "https://www.bilibili.com/video/BV1PN411X7QW",
      "https://www.bilibili.com/video/BV1Dp4y1H7iB",
      "https://www.bilibili.com/video/BV1bi4y1P7Eh",
      "https://www.bilibili.com/video/BV1vQ4y1Z7C2",
      "https://www.bilibili.com/video/BV1oU4y1h7Sc",
    ]
  
const CUSTOM_CSS = `#pio-container {
    display: block !important;
    bottom: -0.3rem;
    z-index: 22637261;
    transition: transform 0.3s;
    cursor: grab;
  }
  
  #pio-container:hover {
    transform: translateY(-0.3rem);
  }
  
  #pio-container:active {
    cursor: grabbing;
  }
  
  #pio-container .pio-dialog {
    right: 10%;
    line-height: 1.5;
    background: rgba(255, 255, 255, 0.9);
  }
  
  #pio {
    height: 240px;
  }
  
  .pio-action .pio-home {
    display: none;
  }
  #pio-container[data-model='Diana'] .pio-action .pio-skin {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M463.423 188.546c-8.001-41.484-41.374-79.627-89.218-90.64-24.113-5.537-50.306-4.112-72.776 5.643-18.138 7.892-32.715 21.265-41.593 37.048-9.371-15.181-21.317-29.102-37.211-39.678-9.917-6.576-21.371-11.726-33.482-14.357-12.881-2.795-26.306-2.687-39.24-.166-24.715 4.823-46.746 18.031-63.952 33.813-16.112 14.797-28.277 32.277-37.045 51.074-17.812 38.309-19.51 81.163-8.767 121.112 11.617 43.347 36.879 83.299 67.676 118.535 31.567 36.059 70.751 71.952 123.853 81.6 12.934 2.356 26.25 3.123 39.347 1.699 12.496-1.371 24.331-4.385 35.84-8.769 21.866-8.33 41.103-21.811 57.212-36.935 35.239-33.046 58.474-74.86 74.695-117.276 8.329-21.81 15.072-44.115 20.387-66.639 5.862-24.99 9.207-50.69 4.274-76.064z' fill='%23FC6078'/%3E%3Cpath d='M464.191 188.546c-3.563-18.358-12.055-36.06-24.607-51.021a110.112 110.112 0 0 1 10.303 29.541c4.932 25.371 1.59 51.073-4.329 76.117-5.316 22.524-12.057 44.828-20.387 66.639-16.222 42.415-39.402 84.284-74.695 117.275-16.166 15.124-35.399 28.55-57.212 36.935-11.506 4.384-23.345 7.398-35.839 8.77-13.097 1.424-26.414.657-39.347-1.699-53.104-9.701-92.341-45.542-123.852-81.6-8.439-9.646-16.495-19.673-23.948-30.033 11.017 18.086 24.057 35.294 38.197 51.516 31.566 36.058 70.749 71.953 123.85 81.597 12.933 2.357 26.25 3.125 39.347 1.7 12.496-1.369 24.334-4.384 35.841-8.767 21.867-8.331 41.099-21.812 57.212-36.938 35.237-33.044 58.473-74.858 74.695-117.274 8.33-21.812 15.071-44.116 20.386-66.638 5.973-25.046 9.26-50.746 4.385-76.12z' fill='%23DC2F42'/%3E%3Cpath d='M320.666 209.48c6.138-7.343 9.973-16 11.287-25.482 1.81-13.262-1.149-27.234-8.492-38.47 8.876 1.59 17.754 2.96 26.745 3.838 10.409.985 21.316 1.478 31.672-.607 5.809-1.148 11.125-3.671 15.619-7.452 5.043-4.219 7.892-10.904 8.055-17.426.166-5.973-2.083-12.112-5.425-16.987-1.863-2.688-3.945-5.262-6.246-7.509-2.194-2.193-4.66-4.003-7.127-5.863-8.218-6.194-17.425-10.851-27.07-14.36-18.03-6.521-38.086-7.781-56.884-3.673a282.462 282.462 0 0 0 6.411-12.109c2.522-5.095 5.097-10.303 6.688-15.727 1.862-6.247 2.191-12.604 1.041-19.018-2.139-11.616-11.73-20.386-23.126-22.631-9.975-1.973-20.169-.713-30.087.985-5.646.986-11.015 2.575-16.22 5.096-5.59 2.685-10.085 6.852-13.758 11.783-6.027 8.002-8.164 18.579-8.548 28.387-.218 5.536.329 11.07 1.097 16.551.165 1.423.383 2.794.658 4.219-2.522-1.753-5.208-3.342-7.948-4.767a93.491 93.491 0 0 0-26.03-9.042c-9.317-1.809-19.345-3.014-28.826-1.864-6.192.714-12.274 2.081-17.699 5.315a33.236 33.236 0 0 0-11.07 10.853c-2.685 4.219-4.33 9.754-4.055 14.741.383 6.028 2.465 11.781 6.136 16.659 11.892 15.838 30.306 25.866 49.487 29.811 9.426 1.918 19.068 2.85 28.714 3.727 0 0 0 .054-.054.054-3.781 3.288-7.507 6.631-11.071 10.137-6.301 6.194-12.164 12.661-17.481 19.731-2.299 3.068-4.437 6.3-6.137 9.754-2.027 4.001-4 8.441-4.768 12.933-.547 3.506-.822 7.015.33 10.411 1.15 3.4 2.85 6.193 5.316 8.879 3.396 3.671 8.22 6.248 12.986 7.564 9.098 2.575 18.688.82 27.073-3.124 7.837-3.672 14.468-10.03 20.058-16.551 4-4.603 7.891-9.425 11.452-14.413.219 1.151.494 2.302.767 3.398 2.412 9.426 7.069 18.632 14.358 25.154 6.958 6.193 16.058 10.577 25.592 10.302 10.358-.274 20.058-5.37 26.58-13.207z' fill='%23A4CE50'/%3E%3Cpath d='M100.528 144.376c-2.686-2.465-6.52-2.465-9.207 0-7.673 7.233-13.097 17.045-14.794 27.511-.549 3.343.876 7.179 4.546 7.999 3.126.713 7.398-.93 8.004-4.546.383-2.247.876-4.439 1.586-6.578.22-.603.385-1.15.604-1.752.054-.111.275-.713.385-.988.164-.274.382-.82.382-.875l.823-1.644a38.352 38.352 0 0 1 3.453-5.482c.11-.109.382-.437.493-.656l.985-1.151a30.092 30.092 0 0 1 2.63-2.631c2.575-2.356 2.631-6.905.11-9.207zm-16.934 56.281c-.272-.822-.711-1.478-1.369-2.081-.603-.658-1.261-1.097-2.083-1.372-.766-.382-1.589-.601-2.52-.547-.604.055-1.15.165-1.755.219-1.094.328-2.082.877-2.849 1.7-.329.438-.658.877-1.04 1.314-.605 1.042-.877 2.081-.877 3.288v1.042c-.057.876.165 1.754.547 2.52.275.822.712 1.481 1.37 2.083.603.657 1.261 1.096 2.082 1.369.767.385 1.59.603 2.522.549.602-.056 1.15-.164 1.754-.218 1.094-.331 2.081-.878 2.849-1.7.33-.439.658-.878 1.04-1.316.605-1.04.878-2.082.878-3.287v-1.042c.056-.877-.111-1.753-.549-2.521z' fill='%23FFF'/%3E%3Cpath d='M395.142 176.654c-1.043-3.782-5.373-6.466-9.153-5.206-3.835 1.26-6.302 5.152-5.206 9.151.164.602.272 1.263.437 1.863 0 .111.057.221.057.277v.272c0 .658.054 1.261.054 1.918 0 .11-.054.877-.054 1.369-.057.331-.222 1.262-.222 1.371-.163.603-.328 1.261-.493 1.864-.052.165-.381.987-.492 1.314 0 .057-.054.11-.111.166-.162.384-.384.767-.602 1.15-1.917 3.398-.932 8.276 2.684 10.192 3.509 1.865 8.166.988 10.194-2.684 3.947-6.905 4.987-15.181 2.907-23.017zm-15.072 84.504c-3.728-.822-8.33 1.095-9.151 5.205l-2.304 11.4c-.764 3.836 1.097 8.218 5.208 9.152 3.726.821 8.331-1.097 9.152-5.206l2.301-11.397c.768-3.784-1.096-8.223-5.206-9.154zm-72.668-2.466a6.508 6.508 0 0 1-.437-.877c0-.054-.056-.163-.056-.219-.108-.384-.272-.822-.382-1.207 0-.108-.111-.546-.165-.82 0-.221-.054-.548-.054-.603 0-.439-.055-.821 0-1.26 0-.33.054-.713.054-1.044 0-.108.054-.216.109-.436.768-3.836-1.095-8.221-5.205-9.153-3.727-.877-8.33 1.152-9.153 5.207-1.315 6.247-.493 12.385 2.522 18.03 1.81 3.453 6.904 4.823 10.193 2.684 3.397-2.356 4.548-6.63 2.574-10.302zm47.843 84.941c-4 .166-7.507 3.289-7.454 7.454 0 1.042 0 2.083-.108 3.125 0 .054-.057.492-.11.767a13.755 13.755 0 0 1-.219 1.038c-.164.879-.44 1.811-.714 2.688-.163.546-.327 1.096-.547 1.643-.109.274-.711 1.7-.164.438-1.589 3.561-1.152 8.166 2.683 10.194 3.235 1.697 8.497 1.152 10.195-2.686 2.465-5.479 3.892-11.124 3.837-17.152.055-3.947-3.344-7.672-7.399-7.509zm-62.146-15.562c-.493-.712-.986-1.371-1.424-2.138-.218-.384-.437-.767-.602-1.096-.055-.109-.109-.218-.109-.275-.057-.055-.057-.162-.109-.273-.166-.383-.276-.822-.384-1.206-.221-.821-.384-1.644-.55-2.52-.604-3.891-5.644-6.358-9.151-5.207-4.165 1.37-5.864 5.043-5.207 9.151.659 3.947 2.303 7.837 4.66 11.071 2.3 3.124 6.575 5.041 10.192 2.685 3.124-1.973 5.207-6.795 2.684-10.192zm-68.5-89.491c-4.055.163-7.454 3.288-7.454 7.453v15.288c0 3.892 3.454 7.62 7.454 7.456 4.055-.167 7.453-3.29 7.453-7.456v-15.288c0-3.891-3.398-7.672-7.453-7.453zm-76.227-4.438c0-.056 0-.056-.056-.056l.056.056s-.056-.056-.056-.113c-.221-.436-.165-.493-.056-.162a5.171 5.171 0 0 1-.272-.877 9.486 9.486 0 0 1-.276-1.206v-.219c.055-.767 0-1.59.055-2.357v-.054c.166-.492.273-1.042.384-1.535 1.096-3.726-1.316-8.274-5.208-9.151-4-.931-7.999 1.205-9.15 5.205-1.809 6.084-.986 12.332 1.751 18.03 1.701 3.508 7.017 4.714 10.195 2.687 3.564-2.412 4.439-6.523 2.633-10.248z' fill='%23FFF' opacity='.4'/%3E%3Cpath d='M148.316 234.029c0-.053-.056-.108-.056-.162 0 .054.056.109.056.162zm-65.433 39.459l-.221-.219-.657-.986c-.272-.439-.548-.877-.765-1.315-.057-.11-.276-.493-.383-.823-.057-.219-.167-.438-.221-.547a14.963 14.963 0 0 1-.439-1.48c-.11-.384-.165-.823-.274-1.206 0-.11-.053-.163-.053-.274v-.218c-.385-3.892-3.18-7.673-7.454-7.454-3.726.164-7.893 3.287-7.454 7.454.658 6.686 3.013 12.44 7.398 17.59 2.521 2.96 7.947 2.793 10.578 0 2.849-3.123 2.63-7.343-.055-10.522zm75.406 61.816c-1.973-3.453-4-6.85-5.972-10.303-1.974-3.398-6.852-4.878-10.195-2.684-3.396 2.19-4.766 6.575-2.685 10.193 1.975 3.452 4.001 6.848 5.975 10.302 1.973 3.397 6.848 4.877 10.191 2.685 3.454-2.192 4.824-6.633 2.686-10.193zm68.831 19.893c-.494-5.589-1.59-10.959-3.727-16.165-1.478-3.564-4.986-6.577-9.152-5.207-3.452 1.095-6.796 5.315-5.205 9.15a55.079 55.079 0 0 1 2.246 6.577c.273 1.042.494 2.028.656 3.07.057.328.111.766.166.876.055.547.11 1.096.165 1.589.328 3.891 3.178 7.673 7.452 7.454 3.727-.057 7.783-3.179 7.399-7.344zm-73.762 44.718a36.068 36.068 0 0 1-2.961-2.796c-.494-.546-.986-1.039-1.479-1.587-.164-.165-.767-.933-.823-.988a42.168 42.168 0 0 1-3.834-6.411c-1.7-3.506-7.016-4.768-10.195-2.685-3.616 2.3-4.494 6.467-2.685 10.193a46.762 46.762 0 0 0 11.4 14.74c2.958 2.521 7.672 3.125 10.577 0 2.573-2.685 3.178-7.726 0-10.466zm78.53 32.716c-2.028-1.698-4.112-3.399-6.139-5.097-1.534-1.315-3.179-2.191-5.26-2.191-1.808 0-4.002.823-5.262 2.191-2.519 2.741-3.178 7.894 0 10.578 2.029 1.696 4.109 3.398 6.139 5.096 1.534 1.313 3.177 2.191 5.26 2.191 1.81 0 4.002-.821 5.262-2.191 2.52-2.795 3.178-7.891 0-10.577zm67.296-44.06c-4.166.164-7.289 3.29-7.453 7.453 0 .657-.056 1.26-.111 1.918v.274c0 .055-.054.166-.054.274a48.353 48.353 0 0 1-.987 4.055c-.164.603-.384 1.151-.601 1.7l-.33.657c-.601 1.262-1.316 2.465-2.084 3.619-2.136 3.287-.766 8.383 2.686 10.191 3.727 1.971 7.892.823 10.194-2.685 3.945-5.974 5.972-12.989 6.248-20.113.109-3.782-3.565-7.507-7.508-7.343zm-205.999-55.02c-.218-.165-.712-.493-1.151-.876 0-.056-.109-.165-.275-.44-.107-.219-.272-.437-.383-.657v-.056c-.055-.273-.163-.494-.218-.766v-1.041c.163-3.892-3.562-7.618-7.453-7.453-4.166.165-7.288 3.287-7.455 7.453-.217 5.317 2.139 11.07 6.358 14.412 1.646 1.261 3.124 2.193 5.26 2.193 1.809 0 4.002-.823 5.262-2.193 2.521-2.74 3.344-8.001.055-10.576zm58.638-200.082c-3.397-1.806-8.33-1.039-10.195 2.687-2.191 4.329-3.395 9.097-3.066 13.974.272 3.893 3.232 7.674 7.452 7.454 3.781-.166 7.782-3.289 7.453-7.454-.055-.877-.055-1.752-.055-2.629v-.329c0-.054.055-.165.055-.329.163-.658.274-1.262.493-1.918.057-.22.163-.439.218-.657.056-.057.111-.221.276-.55 1.808-3.505 1.094-8.274-2.631-10.249z' fill='%23FFF' opacity='.4'/%3E%3C/svg%3E");
  }
  .pio-action span {
    background: none;
    background-size: 100%;
    border: 1px solid #fdcf7b;
    border: 0;
    width: 2em;
    height: 2em;
    margin-bottom: 0.6em;
  }
  .pio-action .pio-home {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M472.86 249.918V361.57c-.024 61.53-49.899 111.404-111.431 111.43h-222.86c-61.529-.026-111.403-49.9-111.428-111.43V249.918a111.828 111.828 0 0 1 35.658-81.79L189.383 50.904c34.128-31.872 87.109-31.872 121.234 0l126.585 117.224a111.825 111.825 0 0 1 35.658 81.79z' fill='%23c3cbd3'/%3E%3Cpath d='M327.334 317.02c-.062 9.206-7.511 16.653-16.717 16.715H189.383c-12.867 0-20.908-13.93-14.475-25.073a16.718 16.718 0 0 1 14.475-8.357h121.234c9.239-.011 16.729 7.478 16.717 16.715z' fill='%23202020'/%3E%3C/svg%3E");
  }
  .pio-action .pio-night {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M186.744 40.493a15.34 15.34 0 0 1 9.956-.097 15.743 15.743 0 0 1 10.643 17.018l-.639 2.794-2.549 8.484a230.05 230.05 0 0 0 21.824 175.818c41.315 73.085 119.925 117.041 203.82 113.977l8.093-.491h2.649c11.217 1.139 18.309 12.601 14.32 23.148l-1.374 2.795-2.256 3.727-6.472 8.533a225.604 225.604 0 0 1-62.629 54.194c-107.795 63.019-245.655 25.599-307.89-83.57-62.235-109.12-25.257-248.695 82.49-311.715a219.638 219.638 0 0 1 17.755-9.319l9.022-4.07 3.286-1.226zm176.702 52.576a4.402 4.402 0 0 1 2.108 2.156l11.181 23.982c1.08 2.305 2.944 4.218 5.297 5.296l24.031 11.182c3.06 1.482 3.366 5.717.554 7.626-.176.12-.361.227-.554.32l-24.031 11.181a10.994 10.994 0 0 0-5.297 5.296l-11.181 24.031c-1.482 3.058-5.717 3.366-7.625.554a4.11 4.11 0 0 1-.32-.554l-11.23-24.031a10.998 10.998 0 0 0-5.297-5.296l-23.981-11.181c-3.06-1.482-3.367-5.717-.555-7.626.176-.12.362-.227.555-.32l24.029-11.182a10.993 10.993 0 0 0 5.249-5.296l11.23-24.031a4.412 4.412 0 0 1 5.837-2.107zm-62.825-73.812c.491.246.883.589 1.08 1.08l5.59 11.967a5.346 5.346 0 0 0 2.649 2.647l12.015 5.592c1.548.699 1.757 2.812.377 3.804-.12.084-.244.157-.377.218l-12.015 5.589a5.496 5.496 0 0 0-2.649 2.649l-5.59 11.966c-.778 1.512-2.9 1.611-3.819.182a2.694 2.694 0 0 1-.105-.182l-5.64-11.966a5.491 5.491 0 0 0-2.649-2.649l-11.966-5.64c-1.548-.699-1.757-2.814-.377-3.803.119-.085.244-.158.377-.218l11.966-5.589a5.498 5.498 0 0 0 2.649-2.65l5.591-11.965a2.205 2.205 0 0 1 2.942-1.08z' fill='%23FFCB3C'/%3E%3C/svg%3E");
  }
  .pio-action .pio-skin {
    background: url("data:image/svg+xml,%3Csvg class='icon' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 512c0 282.774 229.226 512 512 512s512-229.226 512-512S794.774 0 512 0 0 229.226 0 512z' fill='%23FEC43C'/%3E%3Cpath d='M1013.76 408.576C965.632 175.104 759.808 0 512 0 229.376 0 0 229.376 0 512c0 123.904 44.032 236.544 116.736 324.608 87.04 48.128 186.368 74.752 292.864 74.752 301.056 0 550.912-217.088 604.16-502.784z' fill='%23FFD73A'/%3E%3Cpath d='M233.456 460.383a93.759 93.759 0 1 0 187.526 0c0-51.783-41.984-93.76-93.767-93.76s-93.759 41.977-93.759 93.76zm458.39 0c0 51.782 41.976 93.759 93.759 93.759s93.759-41.984 93.759-93.76c0-51.782-41.984-93.758-93.76-93.758-51.782 0-93.758 41.976-93.758 93.759z' fill='%23873A18'/%3E%3Cpath d='M556.41 689.577H410.561c-17.707 0-31.256-13.548-31.256-31.255 0-17.715 13.549-31.256 31.256-31.256h145.85c17.714 0 31.255 13.548 31.255 31.256s-13.549 31.255-31.256 31.255zM320.97 429.127H156.357c-14.588 0-27.089-13.548-27.089-31.256s12.5-31.247 27.097-31.247H320.96c14.58 0 27.089 13.54 27.089 31.247 0 17.715-12.509 31.256-27.097 31.256zm454.215 0H618.92c-17.715 0-31.255-13.548-31.255-31.256s13.548-31.247 31.255-31.247h156.263c17.715 0 31.255 13.54 31.255 31.247 0 17.715-13.548 31.256-31.255 31.256z' fill='%23873A18'/%3E%3Cpath d='M102.4 327.68C46.08 327.68 0 281.6 0 225.28 0 133.12 102.4 0 102.4 0s102.4 133.12 102.4 225.28c0 56.32-46.08 102.4-102.4 102.4z' fill='%2361A3E0'/%3E%3C/svg%3E");
  }
  
  .pio-action .pio-info {
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Crect transform='rotate(45.001 238.211 363.575)' x='29.285' y='22.411' width='273.903' height='505.038' rx='70' ry='70' fill='%23dcdcdc'/%3E%3Cpath d='M218.543 249.999l-47.186 47.186c-8.987 8.988-8.987 22.47 0 31.457 8.988 8.988 22.47 8.988 31.457 0L250 281.456l15.728 15.729c17.976 17.976 17.976 46.063 0 64.038l-64.037 64.038c-17.976 17.975-46.063 17.975-64.038 0l-64.038-64.038c-17.975-17.975-17.975-46.062 0-64.038l64.038-64.037c17.975-17.976 46.062-17.976 64.038 0l16.852 16.851z' fill='%23fff'/%3E%3Cpath d='M281.457 249.999l47.186-47.186c8.988-8.987 8.988-22.469 0-31.457-8.987-8.987-22.469-8.987-31.457 0L250 218.542l-15.729-15.729c-17.975-17.975-17.975-46.062 0-64.037l64.038-64.038c17.975-17.975 46.062-17.975 64.038 0l64.037 64.038c17.977 17.975 17.977 46.062 0 64.037l-64.037 64.038c-17.976 17.976-46.063 17.976-64.038 0l-16.852-16.852z' fill='%2361a3e0'/%3E%3C/svg%3E");
  }
  
  .pio-action .pio-top {
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M262.737 70.075c-3.175-2.89-8.439-5.365-12.737-5.365-4.29 0-9.448 2.37-12.632 5.263l-87.814 87.812c-2.921 3.255-5.23 8.518-5.23 12.73 0 4.203 2.196 9.353 5.118 12.617 3.246 2.915 8.621 5.345 12.842 5.345 4.203 0 9.353-2.197 12.617-5.118l75.093-74.848 74.992 74.993c3.175 2.889 8.433 5.359 12.731 5.359 4.29 0 9.448-2.371 12.632-5.263 2.918-3.247 5.329-8.61 5.329-12.827 0-4.204-2.197-9.354-5.118-12.616zm-103.97 233.514v-36.181H19.695v36.181h51.447v131.444h36.178V303.589zm126.788-35.923h-63.85c-8.732.187-18.571 3.868-25.539 10.451-6.579 6.961-10.367 16.85-10.557 25.589v95.488c.179 8.709 3.781 18.668 10.493 25.582 6.913 6.712 16.839 10.334 25.548 10.514h63.849c8.732-.187 18.571-3.868 25.538-10.45 6.581-6.962 10.368-16.852 10.558-25.59v-95.488c-.187-8.733-3.87-18.573-10.452-25.539-6.962-6.581-16.85-10.367-25.588-10.557zm-.14 131.589l.003.105.403.021a20.74 20.74 0 0 0-.322-.013h-.08c.006.172.014.313.021.414l-.027-.414h-.118l.01-.013.107.005-.007-.117-.033.025-.079.1h-63.648l-.106.003-.032.438c.007-.092.015-.243.021-.438-.163.005-.283.012-.365.017l.365-.023.003-.139-.055-.039-.301-.208.356.244.001-.029v-95.493a3.627 3.627 0 0 0-.004-.108l-.417-.028c.106.007.253.014.417.019a10.069 10.069 0 0 0-.023-.42l.031.42.123.004.016-.022.087-.113.036-.047-.137.182.044.001h63.551l.096.074.064.05-.001.049zm184.441-121.032c-6.963-6.58-16.852-10.367-25.59-10.557h-88.627V435.29h36.181v-68.165h52.39c8.732-.187 18.572-3.87 25.54-10.452 6.579-6.961 10.366-16.851 10.556-25.588v-27.323c-.187-8.733-3.868-18.572-10.45-25.539zm-25.471 52.609l.003.105.437.032a10.682 10.682 0 0 0-.437-.021c.007.211.017.355.023.436l-.033-.436a79.554 79.554 0 0 0-.142-.003l-.038.054-.112.166-.119.175.262-.396H391.82v-27.099h52.451l.112-.004.025-.405a14.96 14.96 0 0 0-.018.405c.171-.006.313-.015.416-.023l-.416.031-.004.122-.01-.008.007-.113-.119.008.041.054.081.062-.001.045z' fill='%234c4c4c'/%3E%3C/svg%3E");
  }
  
  .pio-action .pio-close {
    background: url("data:image/svg+xml,%3Csvg viewBox='0 0 500 500' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M249.999 198.668L352.665 96c14.667-14.666 36.668-14.666 51.335 0 14.666 14.667 14.666 36.668 0 51.334L301.333 250 404 352.668c14.666 14.667 14.666 36.666 0 51.332-14.667 14.667-36.667 14.667-51.334 0L249.999 301.334 147.333 404c-14.668 14.667-36.666 14.667-51.334 0-14.666-14.666-14.666-36.665 0-51.332L198.666 250 95.999 147.334c-14.666-14.666-14.666-36.667 0-51.334 14.668-14.666 36.665-14.666 51.333 0l102.667 102.668z' fill='%23873a18'/%3E%3C/svg%3E");
  }
  `
    // 用到的库
    const LIBS = [
        'https://cdn.jsdelivr.net/gh/starsei/Comic@master/static/js/live2d/lib/pio.js',
        'https://cdn.jsdelivr.net/gh/starsei/Comic@master/static/js/live2d/lib/pio.css',
        'https://cdn.jsdelivr.net/npm/greensock@1.20.2/dist/TweenLite.js',
        'https://cubism.live2d.com/sdk-web/cubismcore/live2dcubismcore.min.js',
        'https://cdn.jsdelivr.net/npm/pixi.js@5.3.6/dist/pixi.min.js',
        'https://cdn.jsdelivr.net/npm/pixi-live2d-display@0.3.1/dist/cubism4.min.js',
        'https://cdn.jsdelivr.net/gh/journey-ad/blog-img@94eb7e2/live2d/lib/pio_sdk4.js'
      ]
    const reqArr = LIBS.map(src => loadSource(src))
  
    // 创建顺序加载队列
    const doTask = reqArr.reduce((prev, next) => prev.then(() => next()), Promise.resolve());
  
    // 队列执行完毕后
    doTask.then(() => {
      // 移除自带看板娘
      const haruna = document.getElementById('my-dear-haruna-vm')
      haruna && haruna.remove()
  
      // 初始化pio
      _pio_initialize_pixi()
  
      // 添加自定义样式
      addStyle(CUSTOM_CSS)
  
      加载圣·嘉然()
  
      // console.log("all done.")
    });
  
    // 初始化设定
    const initConfig = {
      mode: "fixed",
      hidden: true,
      content: {
        link: 引流[Math.floor(Math.random() * 引流.length)], // 引流链接
        referer: "Hi!", // 存在访问来源时的欢迎文本
        welcome: ["Hi!"], // 未开启时间问好时的欢迎文本
        skin: ["诶，想看看其他团员吗？", "替换后入场文本"], // 0更换模型提示文案  1更换完毕入场文案
        night: ["开启夜间模式","关闭夜间模式"],
        custom: [
          // 鼠标移上去提示元素
            //   { "selector": ".most-viewed-panel .most-viewed-item, .live-up-list .live-detail, .card .user-name, .user .name, .post-content .content-full a, .tag-list .content, .title, h2 a[title]", "type": "link" },
            { "selector": ".comment-form", "text": "Content Tooltip" },
            { "selector": ".home-social a:last-child", "text": "Blog Tooltip" },
            { "selector": ".list .postname", "type": "read" },
            { "selector": ".post-content a, .page-content a, .post a", "type": "link" }
        ],
      },
      night: [
        "handsome_UI.light_mode()",
        "handsome_UI.dark_mode()",
      ],
      model: [
        // 待加载的模型列表
        "https://cdn.jsdelivr.net/gh/journey-ad/blog-img/live2d/Diana/Diana.model3.json",
        "https://cdn.jsdelivr.net/gh/journey-ad/blog-img/live2d/Ava/Ava.model3.json",
      ],
      tips: true, // 时间问好
      onModelLoad: onModelLoad // 模型加载完成回调
    }
  
    let pio_reference // pio实例
  
    function 加载圣·嘉然() {
      pio_reference = new Paul_Pio(initConfig)
  
      pio_alignment = "left" // 右下角
  
      const closeBtn = document.querySelector(".pio-container .pio-action .pio-close")
      closeBtn.insertAdjacentHTML('beforebegin', '<span class="pio-top"></span>')
      const topBtn = document.querySelector(".pio-container .pio-action .pio-top")

      // 返回顶部
      topBtn.onclick = function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      };
      topBtn.onmouseover = function () {
        pio_reference.modules.render("想回到页面顶部吗？");
      };
  
      // Then apply style
      pio_refresh_style()
    }
  
    // 模型加载完成回调
    function onModelLoad(model) {
      const canvas = document.getElementById("pio")
      const modelNmae = model.internalModel.settings.name
      const coreModel = model.internalModel.coreModel
      const motionManager = model.internalModel.motionManager
  
      let touchList = [
        {
          text: "点击展示文本1",
          motion: "Idle"
        },
        {
          text: "点击展示文本2",
          motion: "Idle"
        }
      ]
  
      // 播放动作
      function playAction(action) {
        action.text && pio_reference.modules.render(action.text) // 展示文案
        action.motion && pio_reference.model.motion(action.motion) // 播放动作
  
        if (action.from && action.to) {
          // 指定部件渐入渐出
          Object.keys(action.from).forEach(id => {
            const hidePartIndex = coreModel._partIds.indexOf(id)
            TweenLite.to(coreModel._partOpacities, 0.6, { [hidePartIndex]: action.from[id] });
            // coreModel._partOpacities[hidePartIndex] = action.from[id]
          })
  
          motionManager.once("motionFinish", (data) => {
            Object.keys(action.to).forEach(id => {
              const hidePartIndex = coreModel._partIds.indexOf(id)
              TweenLite.to(coreModel._partOpacities, 0.6, { [hidePartIndex]: action.to[id] });
              // coreModel._partOpacities[hidePartIndex] = action.to[id]
            })
          })
        }
      }
  
      canvas.onclick = function () {
        // 除闲置动作外不打断
        if (motionManager.state.currentGroup !== "Idle") return
  
        // 随机选择并播放动作
        const action = pio_reference.modules.rand(touchList)
        playAction(action)
      }
  
      if (modelNmae === "Diana") {
        // 嘉然小姐
  
        // 入场动作及文案
        initConfig.content.skin[1] = ["我是吃货担当 嘉然 Diana~", "嘉心糖们 想然然了没有呀~", "有人在吗？"]
        playAction({ motion: "Tap抱阿草-左手" })
  
        // 点击动作及文案，不区分区域
        touchList = [
          {
            text: "嘉心糖屁用没有",
            motion: "Tap生气 -领结"
          },
          {
            text: "有人急了，但我不说是谁~",
            motion: "Tap= =  左蝴蝶结"
          },
          {
            text: "呜呜...呜呜呜....",
            motion: "Tap哭 -眼角"
          },
          {
            text: "想然然了没有呀~",
            motion: "Tap害羞-中间刘海"
          },
          {
            text: "阿草好软呀~",
            motion: "Tap抱阿草-左手"
          },
          {
            text: "不要再戳啦！好痒！",
            motion: "Tap摇头- 身体"
          },
          {
            text: "嗷呜~~~",
            motion: "Tap耳朵-发卡"
          },
          {
            text: "zzZ。。。",
            motion: "Leave"
          },
          {
            text: "哇！好吃的！",
            motion: "Tap右头发"
          },
        ]
  
      } else if (modelNmae === "Ava") {
        initConfig.content.skin[1] = ["我是<s>拉胯</s>Gamer担当 向晚 AvA~", "怎么推流辣！", "AAAAAAAAAAvvvvAAA 向晚！"]
        playAction({
          motion: "Tap左眼",
          from: {
            "Part15": 1
          },
          to: {
            "Part15": 0
          }
        })
  
        touchList = [
          {
            text: "水母 水母~ 只是普通的生物",
            motion: "Tap右手"
          },
          {
            text: "可爱的鸽子鸽子~我喜欢你~",
            motion: "Tap胸口项链",
            from: {
              "Part12": 1
            },
            to: {
              "Part12": 0
            }
          },
          {
            text: "好...好兄弟之间喜欢很正常啦",
            motion: "Tap中间刘海",
            from: {
              "Part12": 1
            },
            to: {
              "Part12": 0
            }
          },
          {
            text: "啊啊啊！怎么推流辣",
            motion: "Tap右眼",
            from: {
              "Part16": 1
            },
            to: {
              "Part16": 0
            }
          },
          {
            text: "你怎么老摸我，我的身体是不是可有魅力",
            motion: "Tap嘴"
          },
          {
            text: "AAAAAAAAAAvvvvAAA 向晚！",
            motion: "Tap左眼",
            from: {
              "Part15": 1
            },
            to: {
              "Part15": 0
            }
          }
        ]
  
        // 钻头比较大，宽度*1.2倍，模型位移也要重新计算
        canvas.width = model.width * 1.2
        model.x = canvas.width - model.width
  
        // 模型问题，手动隐藏指定部件
        const hideParts = [
          "Part5", // 晕
          "neko", // 喵喵拳
          "game", // 左手游戏手柄
          "Part15", // 墨镜
          "Part21", // 右手小臂
          "Part22", // 左手垂下
          "Part", // 双手抱拳
          "Part16", // 惊讶特效
          "Part12" // 小心心
        ]
        const hidePartsIndex = hideParts.map(id => coreModel._partIds.indexOf(id))
        hidePartsIndex.forEach(idx => {
          coreModel._partOpacities[idx] = 0
        })
      }
    }
  
    // 检测是否处于iframe内嵌环境
    function inIframe() {
      try {
        return window.self !== window.top;
      } catch (e) {
        return true;
      }
    }
  
    // 加载js或css，返回函数包裹的promise实例，用于顺序加载队列
    function loadSource(src) {
      return () => {
        return new Promise(function (resolve, reject) {
          const TYPE = src.split('.').pop()
          let s = null;
          let r = false;
          if (TYPE === 'js') {
            s = document.createElement('script');
            s.type = 'text/javascript';
            s.src = src;
            s.async = true;
  
          } else if (TYPE === 'css') {
            s = document.createElement('link');
            s.rel = 'stylesheet';
            s.type = 'text/css';
            s.href = src;
  
          }
          s.onerror = function (err) {
            reject(err, s);
          };
          s.onload = s.onreadystatechange = function () {
            // console.log(this.readyState); // uncomment this line to see which ready states are called.
            if (!r && (!this.readyState || this.readyState == 'complete')) {
              r = true;
              // console.log(src)
              resolve();
            }
          };
          const t = document.getElementsByTagName('script')[0];
          t.parentElement.insertBefore(s, t);
        });
      }
    }
  
    // 添加css
    function addStyle(css) {
      if (typeof GM_addStyle != "undefined") {
        GM_addStyle(css);
      } else if (typeof PRO_addStyle != "undefined") {
        PRO_addStyle(css);
      } else {
        const node = document.createElement("style");
        node.type = "text/css";
        node.appendChild(document.createTextNode(css));
        const heads = document.getElementsByTagName("head");
  
        if (heads.length > 0) {
          heads[0].appendChild(node);
        } else {
          // no head yet, stick it whereever
          document.documentElement.appendChild(node);
        }
      }
    }
  
})();