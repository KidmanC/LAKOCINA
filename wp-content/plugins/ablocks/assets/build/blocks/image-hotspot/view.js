(()=>{"use strict";const t=class{constructor(t){t&&(this.element=t,this.tooltipContent=this.element.querySelector(".ablocks-image-hotspot__tooltip-content"),this.pins=this.element.querySelectorAll(".ablocks-image-hotspot__pin"),this.activeTooltipIndex=null,this.tooltipContent&&this.pins.length&&(this.tooltipContent.style.display="none",this.initPins()))}initPins(){this.pins.forEach(((t,o)=>{const e=t.dataset.xaxis,i=t.dataset.yaxis,n=t.dataset.trigger;t.style.left=`${e}%`,t.style.top=`${i}%`,"onClick"===n?t.addEventListener("click",(()=>this.handleTooltip(o,e,i))):t.addEventListener("mouseover",(()=>this.handleTooltip(o,e,i)))}))}handleTooltip(t,o,e){const i=this.element.querySelectorAll(".ablocks-block--image-hotspot-child");if(!i)return;if(this.tooltipContent.querySelector(".ablocks-icon.ablocks-icon--close").addEventListener("click",(()=>{this.tooltipContent.style.display="none"})),null!==this.activeTooltipIndex){const t=i[this.activeTooltipIndex]?.children[0];t&&(t.classList.remove("ablocks-image-hotspot__tooltip--active"),this.tooltipContent.style.display="none")}this.activeTooltipIndex=t;const n=i[t]?.children[0];if(n){n.classList.add("ablocks-image-hotspot__tooltip--active");const t=this.tooltipContent.getBoundingClientRect(),i=window.innerWidth,s=window.innerHeight;let l=parseFloat(o),c=parseFloat(e);t.left<0?l=5:t.right>i&&(l=95),t.top<0?c=5:t.bottom>s&&(c=95),this.tooltipContent.style.top=`${c}%`,this.tooltipContent.style.left=`${l}%`,this.tooltipContent.style.display="block"}}};document.addEventListener("DOMContentLoaded",(()=>{document.querySelectorAll(".ablocks-block--image-hotspot").forEach((o=>{new t(o)}))}))})();