package Controller;

import Model.Plateau;
import View.VueAccueil;
import View.VueJeu;

import javax.swing.*;
import java.awt.*;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

/**
 * Contrôleur principal - gère la fenêtre, les événements et la navigation entre vues
 */
public class JeuGUI extends JFrame {
    private CardLayout cardLayout;
    private JPanel mainPanel;
    private VueAccueil vueAccueil;
    private VueJeu vueJeu;
    private Plateau modele;

    public JeuGUI() {
        setTitle("Jeu de Déplacement");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setResizable(false);

        // CardLayout pour naviguer entre vues
        cardLayout = new CardLayout();
        mainPanel = new JPanel(cardLayout);

        // Créer la vue d'accueil
        vueAccueil = new VueAccueil();
        mainPanel.add(vueAccueil, "ACCUEIL");

        // Configurer les boutons de l'accueil
        vueAccueil.getBtnLancer().addActionListener(e -> lancerJeu());
        vueAccueil.getBtnQuitter().addActionListener(e -> System.exit(0));

        add(mainPanel);

        pack();
        setLocationRelativeTo(null);
        setVisible(true);
    }

    /**
     * Lancer le jeu - créer la vue du jeu et la montrer
     */
    private void lancerJeu() {
        // Créer le modèle
        modele = new Plateau(800, 600);

        // Créer la vue du jeu
        vueJeu = new VueJeu(modele);
        mainPanel.add(vueJeu, "JEU");

        // Configurer les écouteurs (clavier + souris)
        configurerEvenements();

        // Afficher la vue du jeu
        cardLayout.show(mainPanel, "JEU");
        vueJeu.requestFocus();
    }

    /**
     * Configurer les écouteurs d'événements (clavier et souris)
     */
    private void configurerEvenements() {
        // ========== CLAVIER ==========
        vueJeu.addKeyListener(new KeyAdapter() {
            @Override
            public void keyPressed(KeyEvent e) {
                char touche = Character.toUpperCase(e.getKeyChar());

                switch (touche) {
                    case 'Z': // Haut
                        modele.deplacerSelection(0, -10);
                        break;
                    case 'Q': // Gauche
                        modele.deplacerSelection(-10, 0);
                        break;
                    case 'S': // Bas
                        modele.deplacerSelection(0, 10);
                        break;
                    case 'W': // Droite
                        modele.deplacerSelection(10, 0);
                        break;
                    case 'R': // Réinitialiser
                        modele.reinitialiser();
                        break;
                }
            }
        });

        // ========== SOURIS ==========
        vueJeu.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent e) {
                // Sélectionner l'élément à cette position
                modele.selectionnerElement(e.getX(), e.getY());
            }
        });

        // Rendre le panneau focalisable pour recevoir les événements clavier
        vueJeu.setFocusable(true);
    }

    /**
     * Point d'entrée du programme
     */
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> new JeuGUI());
    }
}

