package View;

/**
 * Interface pour les écouteurs du modèle
 * Les vues implémentent cette interface pour être notifiées des changements
 */
public interface Ecouteur {
    void modeleMisAJour(Object source);
}

