<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Agenda</title>
  <link rel="stylesheet" href="form.css" type="text/css" />
</head>
<body>
  <h1>Agenda</h1>
  <hr />

  <table width="100%">
    <tr>
      <td width="75%">
        <?php echo isset($zonePrincipale) ? $zonePrincipale : ""; ?>
      </td>

      <td style="background-color:silver; padding:10px;">
        <p>
          <a href="index.php?action=saisir">Nouvelle saisie</a><br>
          <a href="index.php?action=afficher">Voir la liste</a>
        </p>
      </td>
    </tr>
  </table>

  <hr />
</body>
</html>
