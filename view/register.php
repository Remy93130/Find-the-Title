<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Inscription</h1>
		<p class="lead">Remplissez le formulaire ci-dessous afin de pouvoir commencer à jouer.</p>
	</div>
</div>
<div class="col-lg-6 offset-lg-3">
	<form action="index.php?action=registration" method="post">
		<div class="form-group">
			<label for="username">Nom de compte :</label>
			<input type="text" name="username" id="username" class="form-control">
			<p id="error-username"></p>
		</div>
		<div class="form-group">
			<label for="pwd">Mot de passe :</label>
			<input type="password" name="password" class="form-control">
			<input type="text" name="token" id="token" value="<?= $token; ?>" hidden="hidden">
		</div>
		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" name="cgu" id="cgu">
			<label class="form-check-label" for="cgu">J'accepte les condition général d'utilisation</label>
		</div>
		<button type="submit" class="btn btn-primary">S'inscrire</button>
	</form><br>
</div>
<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Condition Général d'Utilisation (CGU)</h1>
		<p class="lead">
			<a href="file/cgu.pdf" target="_blank">Vous pouvez également téléchargement le document</a>
		</p>
	</div>
</div>

<div class="col-lg-6 offset-lg-3">
	<h2 class="text-center">Conditions générales d'utilisation du site "Find the Title"</h2><br>
	<p class="text-justify" style="text-indent: 3rem">
		Le présent document a pour objet de définir les modalités et conditions dans lesquelles d’une part, 
		Barberet Rémy, ci-après dénommé l'éditeur, met à la disposition de ses utilisateurs le site, et les 
		services disponibles sur le site et d’autre part, la manière par laquelle l’utilisateur accède au 
		site et utilise ses services.<br>
		Toute connexion au site est subordonnée au respect des présentes conditions. 
		Pour l’utilisateur, le simple accès au site de l'éditeur à l’adresse URL suivante TODO implique 
		l’acceptation de l’ensemble des conditions décrites ci-après.
	</p><br>
	<h3>Propriété intellectuelle</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		Tous les éléments de ce site, y compris les documents téléchargeables, sont libres de droit. A 
		l’exception de l’iconographie, la reproduction des pages de ce site est autorisée à la condition 
		d’y mentionner la source. Elles ne peuvent être utilisées à des fins commerciales et publicitaires. 
	</p><br>
	<h3>Liens hypertextes</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		Le site Find the Title peut contenir des liens hypertextes vers d’autres sites présents sur le 
		réseau Internet. Les liens vers ces autres ressources vous font quitter le site Find the Title<br>
		Il est possible de créer un lien vers la page de présentation de ce site sans autorisation expresse 
		de l'éditeur. Aucune autorisation ou demande d’information préalable ne peut être exigée par 
		l’éditeur à l’égard d’un site qui souhaite établir un lien vers le site de l’éditeur. Il convient 
		toutefois d’afficher ce site dans une nouvelle fenêtre ou onglet du navigateur. Cependant, 
		l'éditeur se réserve le droit de demander la suppression d’un lien qu’il estime non conforme à 
		l’objet du site Find the Title. 
	</p><br>
	<h3>Responsabilité de l’éditeur</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		Les informations et/ou documents figurant sur ce site et/ou accessibles par ce site proviennent 
		de sources considérées comme étant fiables.<br>
		Toutefois, ces informations et/ou documents sont susceptibles de contenir des inexactitudes 
		techniques et des erreurs typographiques.<br> 
		l'éditeur se réserve le droit de les corriger, dès que ces erreurs sont portées à sa connaissance.<br> 
		Il est fortement recommandé de vérifier l’exactitude et la pertinence des informations et/ou 
		documents mis à disposition sur ce site.<br> 
		Les informations et/ou documents disponibles sur ce site sont susceptibles d’être modifiés à tout 
		moment, et peuvent avoir fait l’objet de mises à jour. En particulier, ils peuvent avoir fait l’objet 
		d’une mise à jour entre le moment de leur téléchargement et celui où l’utilisateur en prend connaissance.<br>
		L’utilisation des informations et/ou documents disponibles sur ce site se fait sous l’entière et seule 
		responsabilité de l’utilisateur, qui assume la totalité des conséquences pouvant en découler, sans que 
		l'éditeur puisse être recherché à ce titre, et sans recours contre ce dernier.<br> 
		l'éditeur ne pourra en aucun cas être tenu responsable de tout dommage de quelque nature qu’il soit 
		résultant de l’interprétation ou de l’utilisation des informations et/ou documents disponibles sur ce site.
	</p><br>
	<h3>Accès au site</h3>
	<p class="text-justify" style="text-indent: 3rem">
		L’éditeur s’efforce de permettre l’accès au site 24 heures sur 24, 7 jours sur 7, sauf en cas de force 
		majeure ou d’un événement hors du contrôle de l'éditeur, et sous réserve des éventuelles pannes et 
		interventions de maintenance nécessaires au bon fonctionnement du site et des services.<br>
		Par conséquent, l'éditeur ne peut garantir une disponibilité du site et/ou des services, une fiabilité 
		des transmissions et des performances en termes de temps de réponse ou de qualité. Il n’est prévu 
		aucune assistance technique vis à vis de l’utilisateur que ce soit par des moyens 
		électronique ou téléphonique.<br>
		<br>
		La responsabilité de l’éditeur ne saurait être engagée en cas d’impossibilité d’accès à ce site 
		et/ou d’utilisation des services.<br> 
		<br>
		Par ailleurs, l'éditeur peut être amené à interrompre le site ou une partie des services, à tout moment 
		sans préavis, le tout sans droit à indemnités. L’utilisateur reconnaît et accepte que l'éditeur ne soit 
		pas responsable des interruptions, et des conséquences qui peuvent en découler pour l’utilisateur ou 
		tout tiers. 
	</p><br>
	<h3>Modification des conditions d’utilisation</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		l'éditeur se réserve la possibilité de modifier, à tout moment et sans préavis, les présentes 
		conditions d’utilisation afin de les adapter aux évolutions du site et/ou de son exploitation. 
	</p><br>
	<h3>Règles d'usage d'Internet</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		L’utilisateur déclare accepter les caractéristiques et les limites d’Internet, et 
		notamment reconnaît que : <br>
		l'éditeur n’assume aucune responsabilité sur les services accessibles par Internet et n’exerce aucun 
		contrôle de quelque forme que ce soit sur la nature et les caractéristiques des données qui pourraient 
		transiter par l’intermédiaire de son centre serveur.<br>
		L’utilisateur reconnaît que les données circulant sur Internet ne sont pas protégées notamment contre 
		les détournements éventuels. La présence du logo   Find the Title institue une présomption simple de 
		validité. La communication de toute information jugée par l’utilisateur de nature sensible ou confidentielle 
		se fait à ses risques et périls. <br>
		L’utilisateur reconnaît que les données circulant sur Internet peuvent être réglementées en termes d’usage 
		ou être protégées par un droit de propriété. <br>
		L’utilisateur est seul responsable de l’usage des données qu’il consulte, interroge et transfère sur Internet.<br>
		L’utilisateur reconnaît que l'éditeur ne dispose d’aucun moyen de contrôle sur le contenu des services 
		accessibles sur Internet
	</p><br>
	<h3>Droit applicable</h3><br>
	<p class="text-justify" style="text-indent: 3rem">
		Tant le présent site que les modalités et conditions de son utilisation sont régis par le droit français, 
		quel que soit le lieu d’utilisation. En cas de contestation éventuelle, et après l’échec de toute tentative 
		de recherche d’une solution amiable, les tribunaux français seront seuls compétents pour connaître de ce litige.
		Pour toute question relative aux présentes conditions d’utilisation du site, vous pouvez me contacter 
		à l’adresse suivante : <br>
		remy93130@gmail.com
	</p>
</div>
