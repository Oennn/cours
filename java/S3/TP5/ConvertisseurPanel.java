import javax.swing.*;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import java.awt.*;
import java.text.DecimalFormat;

public class ConvertisseurPanel extends JPanel {

    private JTextField champDevise1;
    private JTextField champDevise2;
    private JButton btnC;
    private JButton btn1Vers2;
    private JButton btn2Vers1;

    private Devise devise1;
    private Devise devise2;

    private boolean isUpdatingFromModel = false;
    private static final DecimalFormat DECIMAL_FORMAT = new DecimalFormat("0.00");

    public ConvertisseurPanel() {
        devise1 = new Devise("Euro", "€", 1.0);
        devise2 = new Devise("Dollar", "$", 1.08);

        // Layout principal : BorderLayout (pour empiler les 2 conteneurs)
        setLayout(new BorderLayout(0, 5));
        setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));

        // ═══════════════════════════════════════════════════════════
        // CONTENEUR 1 : Les champs (2 lignes, 1 colonnes)
        // ═══════════════════════════════════════════════════════════
        JPanel panelChamps = new JPanel();
        panelChamps.setLayout(new GridLayout(2, 1, 5, 5));

        // Ligne 1 : Devise 1
        //
        //panelChamps.add(new JLabel());
        champDevise1 = new JTextField("0.00");
        champDevise1.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                onDevise1Changed();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                onDevise1Changed();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                onDevise1Changed();
            }
        });
        panelChamps.add(champDevise1);

        // Ligne 2 : Devise 2
        //panelChamps.add(new JLabel());
        champDevise2 = new JTextField("0.00");
        champDevise2.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                onDevise2Changed();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                onDevise2Changed();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                onDevise2Changed();
            }
        });
        panelChamps.add(champDevise2);

        // ═══════════════════════════════════════════════════════════
        // CONTENEUR 2 : Les boutons (1 ligne, 3 colonnes)
        // ═══════════════════════════════════════════════════════════
        JPanel panelBoutons = new JPanel();
        panelBoutons.setLayout(new GridLayout(1, 3, 5, 5));

        btnC = new JButton("C");
        btnC.addActionListener(e -> reinitialiser());
        panelBoutons.add(btnC);

        btn1Vers2 = new JButton("→");
        btn1Vers2.addActionListener(e -> convertir1Vers2());
        panelBoutons.add(btn1Vers2);

        btn2Vers1 = new JButton("←");
        btn2Vers1.addActionListener(e -> convertir2Vers1());
        panelBoutons.add(btn2Vers1);

        // ═══════════════════════════════════════════════════════════
        // AJOUTER LES 2 CONTENEURS AU LAYOUT PRINCIPAL
        // ═══════════════════════════════════════════════════════════
        add(panelChamps, BorderLayout.NORTH);   // En haut
        add(panelBoutons, BorderLayout.SOUTH);  // En bas
    }

    private void onDevise1Changed() {
        if (isUpdatingFromModel) {
            return;
        }

        try {
            String text = champDevise1.getText().trim();
            if (text.isEmpty()) {
                return;
            }
            double montant = Double.parseDouble(text);
            double resultat = Devise.convertir(montant, devise1, devise2);

            isUpdatingFromModel = true;
            champDevise2.setText(DECIMAL_FORMAT.format(resultat));
            isUpdatingFromModel = false;
        } catch (NumberFormatException ex) {
            // Ignore les entrées invalides
        }
    }

    private void onDevise2Changed() {
        if (isUpdatingFromModel) {
            return;
        }

        try {
            String text = champDevise2.getText().trim();
            if (text.isEmpty()) {
                return;
            }
            double montant = Double.parseDouble(text);
            double resultat = Devise.convertir(montant, devise2, devise1);

            isUpdatingFromModel = true;
            champDevise1.setText(DECIMAL_FORMAT.format(resultat));
            isUpdatingFromModel = false;
        } catch (NumberFormatException ex) {
            // Ignore les entrées invalides
        }
    }

    private void convertir1Vers2() {
        try {
            double montant = Double.parseDouble(champDevise1.getText());
            double resultat = Devise.convertir(montant, devise1, devise2);

            isUpdatingFromModel = true;
            champDevise2.setText(DECIMAL_FORMAT.format(resultat));
            isUpdatingFromModel = false;
        } catch (NumberFormatException ex) {
            JOptionPane.showMessageDialog(this, "Veuillez entrer un nombre valide", "Erreur", JOptionPane.ERROR_MESSAGE);
        }
    }

    private void convertir2Vers1() {
        try {
            double montant = Double.parseDouble(champDevise2.getText());
            double resultat = Devise.convertir(montant, devise2, devise1);

            isUpdatingFromModel = true;
            champDevise1.setText(DECIMAL_FORMAT.format(resultat));
            isUpdatingFromModel = false;
        } catch (NumberFormatException ex) {
            JOptionPane.showMessageDialog(this, "Veuillez entrer un nombre valide", "Erreur", JOptionPane.ERROR_MESSAGE);
        }
    }

    private void reinitialiser() {
        isUpdatingFromModel = true;
        champDevise1.setText("0.00");
        champDevise2.setText("0.00");
        isUpdatingFromModel = false;
    }
}

