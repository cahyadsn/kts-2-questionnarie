<?php 
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME     : assets/js/kts.en.v2.php
AUTHOR       : CAHYA DSN
CREATED DATE : 2017-12-12
UPDATED DATE : 2026-07-06 08:55:00
DEMO SITE    : http://psycho.cahyadsn.com/kts
SOURCE CODE  : https://github.com/cahyadsn/kts-2-questionnarie
================================================================================ */
header("Content-type: text/javascript");
?>
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('radio-input')) {
        var td = e.target.closest('td');
        if (td && td.previousElementSibling) {
            td.previousElementSibling.classList.remove('incomplete');
        }
        var tr = e.target.closest('tr');
        if (tr && tr.previousElementSibling) {
            var children = tr.previousElementSibling.children;
            for (var i = 0; i < children.length; i++) {
                children[i].classList.remove('incomplete');
            }
        }
    }
});

var btnBack = document.getElementById('btn_back');
var btnNext = document.getElementById('btn_next');
var btnKirim = document.getElementById('btn_kirim');
var inputPage = document.getElementById('page');

if (btnBack) {
    btnBack.addEventListener('click', function(e) {
        e.preventDefault();
        var tbodies = document.querySelectorAll('tbody[id^="p"]');
        for (var i = 0; i < tbodies.length; i++) {
            tbodies[i].style.display = 'none';
        }
        var h = parseInt(inputPage.value, 10) - 1;
        inputPage.value = h;
        var targetTbody = document.getElementById('p' + h);
        if (targetTbody) {
            targetTbody.style.display = '';
        }
        if (h === 0) {
            btnBack.classList.add('disabled');
            btnBack.disabled = true;
        }
        if (h < 9) {
            if (btnNext) {
                btnNext.classList.remove('disabled');
                btnNext.disabled = false;
            }
            if (btnKirim) {
                btnKirim.classList.add('disabled');
                btnKirim.disabled = true;
            }
        }
    });
}

if (btnNext) {
    btnNext.addEventListener('click', function(e) {
        e.preventDefault();
        var tbodies = document.querySelectorAll('tbody[id^="p"]');
        for (var i = 0; i < tbodies.length; i++) {
            tbodies[i].style.display = 'none';
        }
        var p = parseInt(inputPage.value, 10) + 1;
        inputPage.value = p;
        var targetTbody = document.getElementById('p' + p);
        if (targetTbody) {
            targetTbody.style.display = '';
        }
        if (p >= 0) {
            if (btnBack) {
                btnBack.classList.remove('disabled');
                btnBack.disabled = false;
            }
        }
        if (p === 9) {
            btnNext.classList.add('disabled');
            btnNext.disabled = true;
            if (btnKirim) {
                btnKirim.classList.remove('disabled');
                btnKirim.disabled = false;
            }
        }
    });
}

document.querySelectorAll('.theme-pill').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        var color = this.getAttribute('data-value');
        document.documentElement.setAttribute('data-theme', color);
        
        document.querySelectorAll('.theme-pill').forEach(function(pill) {
            pill.classList.remove('active');
        });
        this.classList.add('active');

        var formData = new FormData();
        formData.append('color', color);
        fetch('assets/js/change.color.php', {
            method: 'POST',
            body: formData
        });
    });
});

if (btnKirim) {
    btnKirim.addEventListener('click', function(e) {
        var ktsForm = document.getElementById('kts');
        if (ktsForm) {
            var answered = 0;
            // Remove incomplete class from all questions
            var tds = ktsForm.querySelectorAll('td');
            for (var i = 0; i < tds.length; i++) {
                tds[i].classList.remove('incomplete');
            }
            
            // Check if we have 70 questions answered
            for (var j = 1; j < 71; j++) {
                var radios = ktsForm.querySelectorAll('input[type="radio"][name^="d[' + j + ']"]');
                var checkedRadio = ktsForm.querySelector('input[type="radio"][name^="d[' + j + ']"]:checked');
                if (checkedRadio) {
                    answered++;
                } else {
                    for (var k = 0; k < radios.length; k++) {
                        var td = radios[k].closest('td');
                        if (td && td.previousElementSibling) {
                            td.previousElementSibling.classList.add('incomplete');
                        }
                    }
                }
            }
            
            if (answered !== 70) {
                // Prevent form submission
                e.preventDefault();
                // Display message
                var msgEl = document.getElementById('msg');
                if (msgEl) {
                    msgEl.innerHTML = 'You have answered ' + answered + ' out of 70 questions.<br>\nPlease review questionnaire and answer marked questions.';
                }
                var warningEl = document.getElementById('warning');
                if (warningEl) {
                    warningEl.classList.add('active');
                }
            }
        }
    });
}
document.querySelectorAll('[data-close="modal"]').forEach(function(el) {
    el.addEventListener('click', function(e) {
        e.preventDefault();
        var modal = this.closest('.modal');
        if (modal) {
            modal.classList.remove('active');
        }
    });
});