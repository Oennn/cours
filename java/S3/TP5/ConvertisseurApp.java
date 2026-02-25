import javax.swing.*;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.text.DecimalFormat;

public class ConvertisseurApp {

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            JFrame frame = new JFrame("Convertisseur de devises");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setSize(400, 200);
            frame.setLocationRelativeTo(null);

            frame.add(new ConvertisseurPanel());

            frame.setVisible(true);
        });
    }
}

// ================== PANEL PRINCIPAL ==================

class ConvertisseurPanel extends JPanel {

    private JTextField champDevise1;
    private JTextField champDevise2;

    private JButton boutonConvert1;
    private JButton boutonConvert2;
    private JButton boutonReset;

    // Exemple : Euro ↔ Dollar
    private final double TAUX = 1.10;

    // Protection boucle infinie
    private boolean modificationInterne = false;

    private DecimalFormat format = new DecimalFormat("#.##");

    public ConvertisseurPanel() {

        setLayout(new GridLayout(3, 1, 10, 10));

        // ===== Champs =====
        champDevise1 = new JTextField();
        champDevise2 = new JTextField();

        JPanel panelChamps = new JPanel(new GridLayout(2, 2, 5, 5));
        panelChamps.add(new JLabel("Euro"));
        panelChamps.add(champDevise1);
        panelChamps.add(new JLabel("Dollar"));
        panelChamps.add(champDevise2);

        // ===== Boutons =====
        boutonConvert1 = new JButton("Euro → Dollar");
        boutonConvert2 = new JButton("Dollar → Euro");
        boutonReset = new JButton("C");

        JPanel panelBoutons = new JPanel(new GridLayout(1, 3, 5, 5));
        panelBoutons.add(boutonConvert1);
        panelBoutons.add(boutonConvert2);
        panelBoutons.add(boutonReset);

        // ===== Assemblage =====
        add(panelChamps);
        add(panelBoutons);

        // Ligne vide pour aération
        add(new JLabel(""));

        // ===== Gestion des boutons =====

        boutonConvert1.addActionListener(e -> convertirVersDevise2());
        boutonConvert2.addActionListener(e -> convertirVersDevise1());
        boutonReset.addActionListener(e -> {
            champDevise1.setText("");
            champDevise2.setText("");
        });

        // ===== Gestion temps réel =====

        champDevise1.getDocument().addDocumentListener(new DocumentListener() {
            public void insertUpdate(DocumentEvent e) {
                convertirAutoVersDevise2();
            }

            public void removeUpdate(DocumentEvent e) {
                convertirAutoVersDevise2();
            }

            public void changedUpdate(DocumentEvent e) {
                convertirAutoVersDevise2();
            }
        });

        champDevise2.getDocument().addDocumentListener(new DocumentListener() {
            public void insertUpdate(DocumentEvent e) {
                convertirAutoVersDevise1();
            }

            public void removeUpdate(DocumentEvent e) {
                convertirAutoVersDevise1();
            }

            public void changedUpdate(DocumentEvent e) {
                convertirAutoVersDevise1();
            }
        });
    }

    // ================== MÉTHODES ==================

    private void convertirVersDevise2() {
        try {
            double valeur = Double.parseDouble(champDevise1.getText());
            double resultat = valeur * TAUX;
            champDevise2.setText(format.format(resultat));
        } catch (Exception ignored) {
        }
    }

    private void convertirVersDevise1() {
        try {
            double valeur = Double.parseDouble(champDevise2.getText());
            double resultat = valeur / TAUX;
            champDevise1.setText(format.format(resultat));
        } catch (Exception ignored) {
        }
    }

    // ===== Version automatique avec protection =====

    private void convertirAutoVersDevise2() {
        if (modificationInterne)
            return;

        try {
            modificationInterne = true;
            double valeur = Double.parseDouble(champDevise1.getText());
            champDevise2.setText(format.format(valeur * TAUX));
        } catch (Exception ignored) {
            champDevise2.setText("");
        } finally {
            modificationInterne = false;
        }
    }

    private void convertirAutoVersDevise1() {
        if (modificationInterne)
            return;

        try {
            modificationInterne = true;
            double valeur = Double.parseDouble(champDevise2.getText());
            champDevise1.setText(format.format(valeur / TAUX));
        } catch (Exception ignored) {
            champDevise1.setText("");
        } finally {
            modificationInterne = false;
        }
    }
}