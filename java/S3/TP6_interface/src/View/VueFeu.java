package View;

import Model.Feu;

import javax.swing.*;
import java.awt.*;

/**
 * La Vue du feu de circulation.
 * Elle s'abonne au modèle et se redessine à chaque changement.
 */
public class VueFeu extends JPanel implements Ecouteur {
    private Feu modele;
    private static final int DIM = 100; // Diamètre des feux [cite: 38]
    private static final int NB_COLORS = 3; // Nombre de feux [cite: 38]

    public VueFeu(Feu modele) {
        this.modele = modele;
        // La vue doit s'abonner auprès du modèle
        this.modele.ajoutEcouteur(this);

        // Définir la taille préférée pour que le composant ne soit pas nul [cite: 37, 39]
        setPreferredSize(new Dimension(DIM, NB_COLORS * DIM));
    }


    /**
     * Cette méthode est appelée automatiquement par le modèle via fireChange()
     */
    @Override
    public void modeleMisAJour(Object source) {
        // Force Java à rappeler paintComponent pour mettre à jour le dessin
        repaint();
    }

    @Override
    protected void paintComponent(Graphics g) {
        // Nettoyage du panel avant de dessiner
        super.paintComponent(g);

        // Calcul des dimensions pour l'adaptation à la taille (Complément du TP) [cite: 54]
        int largeur = getWidth();
        int hauteurUnitaire = getHeight() / NB_COLORS;
        int diametre = Math.min(largeur, hauteurUnitaire); // Garder les feux ronds [cite: 54]

        // Centrage horizontal
        int x = (largeur - diametre) / 2;

        // Dessin des trois feux

        // 1. FEU ROUGE (en haut)
        if (modele.getEtat() == Feu.Couleur.ROUGE) {
            g.setColor(Color.RED);
            g.fillOval(x, 0, diametre, diametre);
        } else {
            g.setColor(Color.BLACK);
            g.drawOval(x, 0, diametre, diametre);
        }

        // 2. FEU ORANGE (au milieu)
        int yOrange = hauteurUnitaire;
        if (modele.getEtat() == Feu.Couleur.ORANGE) {
            g.setColor(Color.ORANGE);
            g.fillOval(x, yOrange, diametre, diametre);
        } else {
            g.setColor(Color.BLACK);
            g.drawOval(x, yOrange, diametre, diametre);
        }

        // 3. FEU VERT (en bas)
        int yVert = 2 * hauteurUnitaire;
        if (modele.getEtat() == Feu.Couleur.VERT) {
            g.setColor(Color.GREEN);
            g.fillOval(x, yVert, diametre, diametre);
        } else {
            g.setColor(Color.BLACK);
            g.drawOval(x, yVert, diametre, diametre);
        }
    }
}