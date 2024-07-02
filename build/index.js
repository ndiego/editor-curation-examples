/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/examples/block-filters/blocks-register-block-type.js":
/*!******************************************************************!*\
  !*** ./src/examples/block-filters/blocks-register-block-type.js ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_0__);
/**
 * WordPress dependencies
 */


/**
 * Adds border support to Column, Heading, and Paragraph blocks.
 *
 * @see https://nickdiego.com/how-to-modify-block-supports-using-client-side-filters/
 *
 * @param {Object} settings - The original block settings.
 * @param {string} name     - The name of the block.
 *
 * @return {Object} The modified block settings with added border support.
 */
function addBorderSupport(settings, name) {
  // Bail if the examples are not enabled.
  if (!window.enableBlockFilters) {
    return settings;
  }

  // Bail early if the block does not have supports.
  if (!settings?.supports) {
    return settings;
  }

  // Only apply to Column, Heading, and Paragraph blocks.
  if (name === 'core/column' || name === 'core/heading' || name === 'core/paragraph') {
    return Object.assign({}, settings, {
      supports: Object.assign(settings.supports, {
        __experimentalBorder: {
          color: true,
          style: true,
          width: true,
          radius: true,
          __experimentalDefaultControls: {
            color: false,
            style: false,
            width: false,
            radius: false
          }
        }
      })
    });
  }
  return settings;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_0__.addFilter)('blocks.registerBlockType', 'modify-block-supports/add-border-support', addBorderSupport);

/**
 * Modifies the default typography settings for blocks with typography support.
 *
 * @see https://nickdiego.com/how-to-modify-block-supports-using-client-side-filters/
 *
 * @param {Object} settings - The original block settings.
 *
 * @return {Object} The modified block settings with updated typography defaults.
 */
function modifyTypographyDefaults(settings) {
  // Bail if the examples are not enabled.
  if (!window.enableBlockFilters) {
    return settings;
  }

  // Only apply to blocks with typography support.
  if (settings?.supports?.typography) {
    return Object.assign({}, settings, {
      supports: Object.assign(settings.supports, {
        typography: Object.assign(settings.supports.typography, {
          __experimentalDefaultControls: {
            fontAppearance: true,
            fontSize: true
          }
        })
      })
    });
  }
  return settings;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_0__.addFilter)('blocks.registerBlockType', 'modify-block-supports/modify-typography-defaults', modifyTypographyDefaults);

/***/ }),

/***/ "./src/examples/editor-filters/block-editor-use-setting-before.js":
/*!************************************************************************!*\
  !*** ./src/examples/editor-filters/block-editor-use-setting-before.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/hooks */ "@wordpress/hooks");
/* harmony import */ var _wordpress_hooks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__);
/**
 * WordPress dependencies
 */



/**
 * Restrict the spacing options for Column blocks to pixels.
 *
 * @see https://developer.wordpress.org/news/2023/05/curating-the-editor-experience-with-client-side-filters/
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 *
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictColumnSpacingSettings(settingValue, settingName, clientId,
// eslint-disable-line
blockName) {
  // Bail if the examples are not enabled.
  if (!window.enableEditorFilters) {
    return settingValue;
  }
  if (blockName === 'core/column' && settingName === 'spacing.units') {
    return ['px'];
  }
  return settingValue;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('blockEditor.useSetting.before', 'editor-curation-examples/useSetting.before/column-spacing', restrictColumnSpacingSettings);

/**
 * If a 'core/heading' is an H3-H6, disable most typography settings and
 * restrict the available font sizes.
 *
 * @see https://developer.wordpress.org/news/2023/05/curating-the-editor-experience-with-client-side-filters/
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 *
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictHeadingTypographySettings(settingValue, settingName, clientId, blockName) {
  // Bail if the examples are not enabled.
  if (!window.enableEditorFilters) {
    return settingValue;
  }
  if (blockName === 'core/heading') {
    var _getBlockAttributes$l;
    const {
      getBlockAttributes
    } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/block-editor');

    // Determine the level of the block based on its client id.
    const headingLevel = (_getBlockAttributes$l = getBlockAttributes(clientId)?.level) !== null && _getBlockAttributes$l !== void 0 ? _getBlockAttributes$l : 0;

    // Modify these block settings.
    const modifiedBlockSettings = {
      'typography.customFontSize': false,
      'typography.fontStyle': false,
      'typography.fontWeight': false,
      'typography.letterSpacing': false,
      'typography.lineHeight': false,
      'typography.textDecoration': false,
      'typography.textTransform': false,
      'typography.fontSizes': [{
        fluid: {
          min: '1rem',
          max: '1.125rem'
        },
        size: '1.125rem',
        slug: 'medium'
      }, {
        fluid: {
          min: '1.75rem',
          max: '1.875rem'
        },
        size: '1.75rem',
        slug: 'large'
      }, {
        fluid: false,
        size: '2.25rem',
        slug: 'x-large'
      }]
      // Add additional block settings here.
    };

    // Only apply setting modifications to H3-H6.
    if (headingLevel >= 3 && modifiedBlockSettings.hasOwnProperty(settingName)) {
      return modifiedBlockSettings[settingName];
    }
  }
  return settingValue;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('blockEditor.useSetting.before', 'editor-curation-examples/useSetting.before/heading-typography', restrictHeadingTypographySettings);

/**
 * If the user doesn't have permission to update settings (Editors,
 * Authors, etc.), disable the specified block settings when editing
 * the specified post types.
 *
 * @see https://developer.wordpress.org/news/2023/05/curating-the-editor-experience-with-client-side-filters/
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 *
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictBlockSettingsByUserPermissionsAndPostType(settingValue, settingName, clientId,
// eslint-disable-line
blockName // eslint-disable-line
) {
  // Bail if the examples are not enabled.
  if (!window.enableEditorFilters) {
    return settingValue;
  }
  const {
    canUser
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core');
  const {
    getCurrentPostType
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/editor');

  // Check user permissions and get the current post type.
  const canUserUpdateSettings = canUser('update', 'settings');
  const currentPostType = getCurrentPostType();

  // Disable block settings on these post types.
  const disabledPostTypes = ['post'
  // Add additional post types here.
  ];

  // Disable these block settings.
  const disabledBlockSettings = ['border.color', 'border.radius', 'border.style', 'border.width'
  // Add additional block settings here.
  ];
  if (!canUserUpdateSettings && disabledPostTypes.includes(currentPostType) && disabledBlockSettings.includes(settingName)) {
    return false;
  }
  return settingValue;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('blockEditor.useSetting.before', 'editor-curation-examples/useSetting.before/user-permissions-and-post-type', restrictBlockSettingsByUserPermissionsAndPostType);

/**
 * If a 'core/button' block is within a 'core/cover' block, update the
 * color palette to only include 'Base" and 'Contrast'. Also disable custom
 * colors and gradients.
 *
 * @see https://developer.wordpress.org/news/2023/05/curating-the-editor-experience-with-client-side-filters/
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 *
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictButtonBlockSettingsByLocation(settingValue, settingName, clientId, blockName) {
  // Bail if the examples are not enabled.
  if (!window.enableEditorFilters) {
    return settingValue;
  }
  if (blockName === 'core/button') {
    const {
      getBlockParents,
      getBlockName
    } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.select)('core/block-editor');

    // Get the block's parents and see if one is a 'core/cover' block.
    const blockParents = getBlockParents(clientId, true);
    const inCover = blockParents.some(parentId => getBlockName(parentId) === 'core/cover');

    // Modify these block settings.
    const modifiedBlockSettings = {
      'color.custom': false,
      'color.customGradient': false,
      'color.defaultGradients': false,
      'color.defaultPalette': false,
      'color.gradients.theme': [],
      'color.palette.theme': [{
        color: '#ffffff',
        name: 'Base',
        slug: 'base'
      }, {
        color: '#000000',
        name: 'Contrast',
        slug: 'contrast'
      }]
      // Add additional block settings here.
    };
    if (inCover && modifiedBlockSettings.hasOwnProperty(settingName)) {
      return modifiedBlockSettings[settingName];
    }
  }
  return settingValue;
}
(0,_wordpress_hooks__WEBPACK_IMPORTED_MODULE_1__.addFilter)('blockEditor.useSetting.before', 'editor-curation-examples/useSetting.before/button-location', restrictButtonBlockSettingsByLocation);

/***/ }),

/***/ "./src/examples/misc-curations.js":
/*!****************************************!*\
  !*** ./src/examples/misc-curations.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/dom-ready */ "@wordpress/dom-ready");
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/**
 * WordPress dependencies
 */



/**
 * Restrict allowed blocks in the Editor.
 */
function restrictAllowedBlocks() {
  const allowedBlocks = ['core/block', 'core/button', 'core/buttons', 'core/code', 'core/column', 'core/columns', 'core/cover', 'core/gallery', 'core/group', 'core/heading', 'core/image', 'core/list', 'core/list-item', 'core/missing',
  // Needed for when a post contains a block type that is no longer supported.
  'core/paragraph', 'core/spacer'];
  (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.getBlockTypes)().forEach(function (blockType) {
    if (allowedBlocks.indexOf(blockType.name) === -1) {
      (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.unregisterBlockType)(blockType.name);
    }
  });
}
_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0___default()(function () {
  // Bail if the examples are not enabled.
  if (window.enableMiscCurations) {
    restrictAllowedBlocks();
  }
});

/***/ }),

/***/ "./src/examples/notes-demo/index.js":
/*!******************************************!*\
  !*** ./src/examples/notes-demo/index.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/dom-ready */ "@wordpress/dom-ready");
/* harmony import */ var _wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/**
 * WordPress dependencies
 */


_wordpress_dom_ready__WEBPACK_IMPORTED_MODULE_0___default()(function () {
  // Only execute if the Notes Demo is enabled and you are editing a 'note'.
  if (window.enableNotesDemo && 'note' === pagenow) {
    // Provided by Core.
    (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.unregisterBlockStyle)('core/image', ['default', 'rounded']);

    // Provided by Twenty Twenty-Four.
    (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.unregisterBlockStyle)('core/list', ['default', 'checkmark']);
    (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.unregisterBlockStyle)('core/heading', ['default', 'asterisk']);
  }
});

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/dom-ready":
/*!**********************************!*\
  !*** external ["wp","domReady"] ***!
  \**********************************/
/***/ ((module) => {

module.exports = window["wp"]["domReady"];

/***/ }),

/***/ "@wordpress/hooks":
/*!*******************************!*\
  !*** external ["wp","hooks"] ***!
  \*******************************/
/***/ ((module) => {

module.exports = window["wp"]["hooks"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _examples_editor_filters_block_editor_use_setting_before__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./examples/editor-filters/block-editor-use-setting-before */ "./src/examples/editor-filters/block-editor-use-setting-before.js");
/* harmony import */ var _examples_block_filters_blocks_register_block_type__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./examples/block-filters/blocks-register-block-type */ "./src/examples/block-filters/blocks-register-block-type.js");
/* harmony import */ var _examples_notes_demo__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./examples/notes-demo */ "./src/examples/notes-demo/index.js");
/* harmony import */ var _examples_misc_curations__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./examples/misc-curations */ "./src/examples/misc-curations.js");




/******/ })()
;
//# sourceMappingURL=index.js.map