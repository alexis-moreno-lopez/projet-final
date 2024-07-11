document.addEventListener('DOMContentLoaded', function() {
    var scrollToTopBtn = document.querySelector('.scroll-to-top');
  
    window.addEventListener('scroll', function() {
      if (window.scrollY > 300) {
        scrollToTopBtn.style.display = 'block';
      } else {
        scrollToTopBtn.style.display = 'none';
      }
    });
  
    scrollToTopBtn.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  });
  $(document).ready(function () {

    // Sélection de tous les champs dans le formulaire
    let allFields = $('form input, form textarea');

    // Configuration des options de Toastr pour les notifications
    toastr.options = {
        "timeOut": 0,             // Temps d'affichage infini
        "extendedTimeOut": 0,     // Temps d'affichage infini après extension
        "closeButton": true,      // Affichage du bouton pour fermer la notification
        "tapToDismiss": false     // Empêche de fermer la notification en tapant dessus
    };

    // Ajout l'étoile (*) pour les champs requis
    allFields.filter('[required]').each(function () {
        let requiredField = $(this);
        requiredField.after('<span class="required-star">*</span>');  // Ajoute un astérisque après le champ requis
    });

    // Objet pour suivre les messages d'erreur affichés
    let displayedErrors = {};

    // Fonction pour gérer l'affichage des erreurs
function handleFieldError(errorMessage, $element) {
    let errorKey = $element.attr('id');  // Clé pour l'erreur basée sur l'ID ou le nom de l'élément
    let isRequired = $element.prop('required');  // Vérifie si le champ est requis
    let isEmpty = $element.val().trim().length === 0;  // Vérifie si le champ est vide

    // Vérifie s'il y a une erreur à afficher
    if (errorMessage) {
        // Vérifie si cette erreur n'a pas déjà été affichée
        if (!displayedErrors[errorKey]) {
            let toast = toastr.error(errorMessage.trim());  // Affiche la notification Toastr d'erreur
            displayedErrors[errorKey] = toast;  // Stocke la référence de la notification pour pouvoir la supprimer plus tard
        }
        $element.addClass("error");  // Ajoute une classe pour indiquer une erreur (style CSS)
        $element.css('border-color', 'red');  // Change la couleur de la bordure en rouge
    } else {
        // Si aucune erreur, nettoie la notification affichée et supprime l'entrée
        if (displayedErrors[errorKey]) {
            toastr.clear(displayedErrors[errorKey]);  // Efface la notification Toastr
            delete displayedErrors[errorKey];  // Supprime l'entrée de l'erreur affichée
        }
        $element.removeClass("error");  // Retire la classe d'erreur (style CSS)
        if (isRequired || !isEmpty) {
            $element.css('border-color', 'green');  // Change la couleur de la bordure en vert
        } else {
            $element.css('border-color', '');  // Réinitialise la couleur de la bordure
        }
    }
}
    // Fonction pour vérifier la présence d'insultes dans le texte
    function containsInsult(text) {
        const insults = [
            "abrut", "abruti", "abrutis", "abrutie", "andouille", "bouffon", "conne", "connard", "connasse",
            "c*nard", "crétine", "débilement", "enculé", "enculée", "enculer", "enculee", "encule", "enflure", "enfoiré",
            "enfoirée", "idiot", "idiote", "imbécile", "imbécillité", "naze", "niais", "salope", "salopard", "stupide",
            "tête de nœud", "trou du cul", "trou de balle", "va te faire", "va te faire foutre", "crétin", "débile",
            "gros connard", "gros nul", "sac à merde"
        ];

       // Convertit le texte en minuscules et divise en mots
       const words = text.toLowerCase().split(/\W+/);

       // Vérifie si l'un des mots est une insulte
       return words.some((word) => insults.includes(word));
    }

    // Fonction de validation des champs
    function validateField($field) {
        let fieldType = $field.attr('type');  // Type de champ (text, tel, email, textarea)
        let fieldContent = $field.val().trim();  // Contenu du champ sans espaces avant et après
        let fieldErrorMessage = "";  // Message d'erreur initialisé à vide
        let isRequired = $field.prop('required');  // Vérifie si le champ est requis

        // Vérification pour le champ de type 'text'
        if (fieldType === 'text') {
            fieldContent = fieldContent.replace(/^-+|-+$/g, '');  // Supprime les tirets en début et fin de chaîne

            // Conditions de validation pour le champ 'text'
            if (fieldContent.length > 50) {
                fieldErrorMessage += "Le nom ne peut pas dépasser 50 caractères. ";
            }

            if (isRequired && fieldContent.length === 0) {
                fieldErrorMessage += "Le champ nom est obligatoire et doit contenir au moins 1 caractère. ";
            }

            if (fieldContent.length > 0 && !/^[A-Za-zÀ-ÿ\s'-]+$/.test(fieldContent)) {
                fieldErrorMessage += "Le nom ne doit contenir que des lettres, espaces, apostrophes, tirets et accents. ";
            }
        }

        // Vérification pour le champ de type 'tel'
        if (fieldType === 'tel') {
            const telephonePattern = /^(\+\d{2}[0-9\s-]{8,18}|(0|\+33\s?|0033\s?)[1-9](?:[\s.-]?[0-9]{2}){4})$/;  // Expression régulière pour le numéro de téléphone
            if (isRequired && fieldContent.length === 0) {
                fieldErrorMessage = "Le champ téléphone est obligatoire. ";
            } else if (fieldContent.length > 0 && !telephonePattern.test(fieldContent)) {
                fieldErrorMessage = "Erreur, le format du numéro de téléphone doit être (+33 6 00 00 00 00) ou (06 00 00 00 00). ";
            }
        }

        // Vérification pour le champ de type 'email'
        if (fieldType === 'email') {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Expression régulière pour l'adresse email
            if (isRequired && fieldContent.length === 0) {
                fieldErrorMessage = "Le champ email est obligatoire. ";
            } else if (fieldContent.length > 0 && !emailPattern.test(fieldContent)) {
                fieldErrorMessage = "Erreur, le format de l'adresse email est invalide. ";
            }
        }

        // Vérification pour le champ de type 'textarea'
        if ($field.is('textarea')) {
            // Conditions de validation pour le champ 'textarea'
            if (isRequired && fieldContent.length === 0) {
                fieldErrorMessage += "Le message est obligatoire. ";
            }

            if (fieldContent.length > 1000) {
                fieldErrorMessage += "Le message ne peut pas dépasser 1000 caractères.\n";
            }

            if (containsInsult(fieldContent)) {
                fieldErrorMessage += "Le message ne doit pas contenir d'insultes.\n";
            }
        }

        // Gestion de l'affichage des erreurs pour le champ actuel
        handleFieldError(fieldErrorMessage, $field);
        return !fieldErrorMessage;  // Retourne vrai si aucune erreur, sinon faux
    }

    // Validation en temps réel pour tous les champs
    allFields.on('input change', function () {
        validateField($(this));
    });

    // Soumission du formulaire
    $("form").submit(function (event) {
        event.preventDefault();  // Empêche l'envoi du formulaire par défaut du navigateur

        let isValid = true;  // Initialise la validation du formulaire à vrai
        toastr.clear();  // Efface toutes les notifications Toastr actives
        displayedErrors = {};  // Réinitialise les erreurs affichées

        // Validation de tous les champs
        allFields.each(function () {
            if (!validateField($(this))) {
                isValid = false;  // S'il y a une erreur, définir la validation du formulaire à faux
            }
        });

        // Si le formulaire est valide, le soumettre
        if (isValid) {
            this.submit();  // Soumission du formulaire
        }
    });
});
