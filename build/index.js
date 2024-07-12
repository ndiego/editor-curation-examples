(()=>{var e={57:()=>{wp.domReady((()=>{window.enableBlockStyles&&wp.blocks.unregisterBlockStyle("core/image",["rounded"])}))},661:()=>{wp.domReady((()=>{window.enableBlockVariations&&(function(){const e=["wordpress","facebook","x","linkedin","github","gravatar"];wp.data.select("core/blocks").getBlockVariations("core/social-link").forEach((function(o){-1===e.indexOf(o.name)&&wp.blocks.unregisterBlockVariation("core/social-link",o.name)}))}(),["animoto","dailymotion","hulu","reddit","tumblr","vine","amazon-kindle","cloudup","crowdsignal","speaker","scribd"].forEach((e=>{wp.blocks.unregisterBlockVariation("core/embed",e)})))}))},60:()=>{wp.domReady((function(){window.enableAllowListGlobal&&function(){const e=["core/block","core/button","core/buttons","core/code","core/column","core/columns","core/cover","core/gallery","core/group","core/heading","core/image","core/list","core/list-item","core/missing","core/paragraph","core/spacer"];wp.blocks.getBlockTypes().getBlockTypes().forEach((function(o){-1===e.indexOf(o.name)&&wp.blocks.unregisterBlockType(o.name)}))}()})),wp.plugins.registerPlugin("editor-curation-examples-allow-blocks-by-post-type-and-user-permissions",{render:()=>{if(!window.enableAllowListLocal)return null;const e=["core/block","core/button","core/buttons","core/code","core/column","core/columns","core/cover","core/gallery","core/group","core/heading","core/image","core/list","core/list-item","core/missing","core/paragraph","core/spacer"],o=wp.data.select("core").canUser("update","settings"),r=wp.data.select("core/editor").getCurrentPostType();if(void 0===o)return null;const t=wp.blocks.getBlockTypes();return o||"post"!==r||t.forEach((function(o){-1===e.indexOf(o.name)&&wp.blocks.unregisterBlockType(o.name)})),null}})},710:()=>{wp.plugins.registerPlugin("editor-curation-examples-disallow-blocks-by-post-type",{render:()=>{if(!window.enableDisallowListLocal)return null;return"post"===wp.data.select("core/editor").getCurrentPostType()&&["core/navigation","core/query"].forEach((function(e){wp.blocks.unregisterBlockType(e)})),null}})},704:()=>{wp.plugins.registerPlugin("editor-curation-examples-notes-demo",{render:()=>window.enableNotesDemo?("note"===wp.data.select("core/editor").getCurrentPostType()&&(wp.blocks.unregisterBlockStyle("core/image",["default","rounded"]),wp.blocks.unregisterBlockStyle("core/list",["default","checkmark"]),wp.blocks.unregisterBlockStyle("core/heading",["default","asterisk"]),["core/image","core/language","core/keyboard","core/subscript","core/superscript"].forEach((function(e){wp.richText.unregisterFormatType(e)}))),null):null})}},o={};function r(t){var n=o[t];if(void 0!==n)return n.exports;var i=o[t]={exports:{}};return e[t](i,i.exports,r),i.exports}(()=>{"use strict";const e=window.wp.data,o=window.wp.hooks;(0,o.addFilter)("blockEditor.useSetting.before","editor-curation-examples/useSetting.before/column-spacing",(function(e,o,r,t){return window.enableBlockFiltersUseSettingBefore&&"core/column"===t&&"spacing.units"===o?["px"]:e})),(0,o.addFilter)("blockEditor.useSetting.before","editor-curation-examples/useSetting.before/heading-typography",(function(o,r,t,n){if(!window.enableBlockFiltersUseSettingBefore)return o;if("core/heading"===n){var i;const{getBlockAttributes:o}=(0,e.select)("core/block-editor"),n={"typography.customFontSize":!1,"typography.fontStyle":!1,"typography.fontWeight":!1,"typography.letterSpacing":!1,"typography.lineHeight":!1,"typography.textDecoration":!1,"typography.textTransform":!1,"typography.fontSizes":[{fluid:{min:"1rem",max:"1.125rem"},size:"1.125rem",slug:"medium"},{fluid:{min:"1.75rem",max:"1.875rem"},size:"1.75rem",slug:"large"},{fluid:!1,size:"2.25rem",slug:"x-large"}]};if((null!==(i=o(t)?.level)&&void 0!==i?i:0)>=3&&n.hasOwnProperty(r))return n[r]}return o})),(0,o.addFilter)("blockEditor.useSetting.before","editor-curation-examples/useSetting.before/user-permissions-and-post-type",(function(o,r,t,n){if(!window.enableBlockFiltersUseSettingBefore)return o;const{canUser:i}=(0,e.select)("core"),{getCurrentPostType:c}=(0,e.select)("core/editor"),s=i("update","settings"),l=c();return!(!s&&["post"].includes(l)&&["border.color","border.radius","border.style","border.width"].includes(r))&&o})),(0,o.addFilter)("blockEditor.useSetting.before","editor-curation-examples/useSetting.before/button-location",(function(o,r,t,n){if(!window.enableBlockFiltersUseSettingBefore)return o;if("core/button"===n){const{getBlockParents:o,getBlockName:n}=(0,e.select)("core/block-editor"),i={"color.custom":!1,"color.customGradient":!1,"color.defaultGradients":!1,"color.defaultPalette":!1,"color.gradients.theme":[],"color.palette.theme":[{color:"#ffffff",name:"Base",slug:"base"},{color:"#000000",name:"Contrast",slug:"contrast"}]};if(o(t,!0).some((e=>"core/cover"===n(e)))&&i.hasOwnProperty(r))return i[r]}return o})),(0,o.addFilter)("blocks.registerBlockType","modify-block-supports/add-border-support",(function(e,o){return window.enableBlockFilters&&e?.supports&&("core/column"===o||"core/heading"===o||"core/paragraph"===o)?Object.assign({},e,{supports:Object.assign(e.supports,{__experimentalBorder:{color:!0,style:!0,width:!0,radius:!0,__experimentalDefaultControls:{color:!1,style:!1,width:!1,radius:!1}}})}):e})),(0,o.addFilter)("blocks.registerBlockType","modify-block-supports/modify-typography-defaults",(function(e){return window.enableBlockFilters&&e?.supports?.typography?Object.assign({},e,{supports:Object.assign(e.supports,{typography:Object.assign(e.supports.typography,{__experimentalDefaultControls:{fontAppearance:!0,fontSize:!0}})})}):e})),r(60),r(710),r(57),r(661),r(704)})()})();