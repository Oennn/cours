package View;

import javax.swing.*;
import java.awt.*;

/**
 * Vue de la page d'accueil - affiche les boutons pour lancer le jeu
 */
public class VueAccueil extends JPanel {
    private JButton btnLancer;
    private JButton btnQuitter;

    public VueAccueil() {
        setLayout(new BorderLayout());
        setBackground(new Color(50, 50, 50));

        // Panel central pour les boutons
        JPanel panelCentral = new JPanel();
        panelCentral.setLayout(new GridLayout(3, 1, 10, 10));
        panelCentral.setBackground(new Color(50, 50, 50));

        // Titre
        JLabel titre = new JLabel("JEU DE DÉPLACEMENT");
        titre.setFont(new Font("Arial", Font.BOLD, 30));
        titre.setForeground(Color.WHITE);
        titre.setHorizontalAlignment(JLabel.CENTER);
        panelCentral.add(titre);

        // Bouton Lancer
        btnLancer = new JButton("LANCER LE JEU");
        btnLancer.setFont(new Font("Arial", Font.BOLD, 16));
        btnLancer.setFocusPainted(false);
        btnLancer.setBackground(new Color(0, 150, 0));
        btnLancer.setForeground(Color.WHITE);
        panelCentral.add(btnLancer);

        // Bouton Quitter
        btnQuitter = new JButton("QUITTER");
        btnQuitter.setFont(new Font("Arial", Font.BOLD, 16));
        btnQuitter.setFocusPainted(false);
        btnQuitter.setBackground(new Color(200, 0, 0));
        btnQuitter.setForeground(Color.WHITE);
        panelCentral.add(btnQuitter);

        add(panelCentral, BorderLayout.CENTER);
    }

    public JButton getBtnLancer() {
        return btnLancer;
    }

    public JButton getBtnQuitter() {
        return btnQuitter;
    }
}

