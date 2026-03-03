package View;

import Model.Plateau;
import Model.Element;

import javax.swing.*;
import java.awt.*;
import java.util.List;

/**
 * Vue du jeu - affiche le plateau et les éléments
 */
public class VueJeu extends JPanel implements Ecouteur {
    private Plateau modele;

    public VueJeu(Plateau modele) {
        this.modele = modele;
        this.modele.ajoutEcouteur(this);

        setPreferredSize(new Dimension(modele.getLargeur(), modele.getHauteur()));
        setBackground(new Color(100, 100, 150));
    }

    @Override
    public void modeleMisAJour(Object source) {
        repaint();
    }

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        Graphics2D g2 = (Graphics2D) g;
        g2.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);

        // Récupérer les éléments du modèle
        List<Element> elements = modele.getElements();
        Element selected = modele.getSelectedElement();

        // Dessiner tous les éléments
        for (Element elem : elements) {
            // Couleur selon si c'est sélectionné ou déplaçable
            if (elem == selected) {
                g2.setColor(new Color(0, 200, 255)); // Cyan si sélectionné
            } else if (elem.estDeplacable()) {
                g2.setColor(new Color(0, 200, 0)); // Vert si déplaçable
            } else {
                g2.setColor(new Color(200, 0, 0)); // Rouge si non déplaçable
            }

            // Dessiner le rectangle
            g2.fillRect(elem.getX(), elem.getY(), elem.getLargeur(), elem.getHauteur());

            // Bordure noire
            g2.setColor(Color.BLACK);
            g2.setStroke(new BasicStroke(2));
            g2.drawRect(elem.getX(), elem.getY(), elem.getLargeur(), elem.getHauteur());
        }

        // Afficher les instructions
        g2.setColor(Color.WHITE);
        g2.setFont(new Font("Arial", Font.PLAIN, 14));
        g2.drawString("Cliquez pour sélectionner | Z/Q/S/W pour déplacer", 10, 20);
        g2.drawString("Vert = déplaçable | Rouge = fixe | Cyan = sélectionné", 10, 40);
    }
}

