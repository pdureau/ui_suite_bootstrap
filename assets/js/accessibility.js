"use strict";!function(t,e){function s(i){t.ui_suite_boostrap_accessibility.pointer_elements.includes(i.tagName.toLowerCase())?(i.setAttribute("tabindex","-1"),i.setAttribute("aria-disabled","true")):Array.from(i.children).forEach(function(i){i.classList.contains("pe-auto")||s(i)})}t.ui_suite_boostrap_accessibility=t.ui_suite_boostrap_accessibility||{},t.ui_suite_boostrap_accessibility.pointer_elements=["a","input"],t.behaviors.ui_suite_boostrap_accessibility={attach:function(i){e("unclickable-element",".pe-none",i).forEach(s)}}}(Drupal,once);