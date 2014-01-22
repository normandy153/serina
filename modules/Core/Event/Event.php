<?php
/**
 * Event model
 *
 * Date: 15/01/2014
 * Time: 12:14 AM
 */
namespace Core;

class Event {

	/**
	 * Identifier
	 *
	 * @var int
	 */
	private $id = 1;

	/**
	 * Event name
	 *
	 * @var string
	 */
	private $name = 'Test Event';

	/**
	 * Event description
	 *
	 * @var string
	 */
	private $description = 'A description for Test Event';

	/**
	 * Start date
	 *
	 * @var string
	 */
	private $startDateTime = '2014-01-15 12:20:00';

	/**
	 * End date
	 *
	 * @var string
	 */
	private $endDateTime = '2014-01-17 17:00:00';

	/**
	 * A collection of Waypoint instances
	 *
	 * @var null
	 */
	private $waypoints = null;

	/**
	 * A collection of User instances
	 *
	 * @var null
	 */
	private $attendees = null;

	/**
	 * A collection of User instances
	 *
	 * @var null
	 */
	private $leaders = null;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Assemble waypoints
		 */
		$waypointCollection = new \Core\Event\Waypoint\Collection();

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('300 Swanston St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('1 Flinders St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('10 Toorak Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('50 Sydney Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('70 Lygon St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('100 Barkers Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('80 Blackburn Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('200 Canterbury Rd, Melbourne');
		$waypointCollection->add($node);

		$node->setAddress('300 Swanston St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('1 Flinders St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('10 Toorak Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('50 Sydney Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('70 Lygon St, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('100 Barkers Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('80 Blackburn Rd, Melbourne');
		$waypointCollection->add($node);

		$node = new \Core\Event\Waypoint\Node();
		$node->setAddress('200 Canterbury Rd, Melbourne');
		$waypointCollection->add($node);

		/* Transcode nodes into a single polyfill collection
		 */
//		$waypointCollection->transcode();

		$allPolyfills = new \App\Collection();
		$allPolyfills->add("`|weFsjxsZlAa@jAc@Ou@a@qB_@oB_AsEm@aD_@iBc@cC]cAIk@SaAuAkHu@sDG{@XiEVqFVoEt@aNr@kNp@{LH{Ab@DrGn@pJz@hIx@xBRXBAT[jFQtCQhEIzAc@xHk@|LAbAJhAZlBzAxHrAw@|@u@t@_AVe@f@gAzBiFnAgBPUv@g@j@Yz@Ut@Mv@AlE@VCXE\Mj@_@|@u@tBwBbAuAxAiBV[Dq@HqAl@yIbAoPd@cH`@_HV}DJ{CTcB@MJBx@DhANb@FNHxFh@hBPJEn@HlDb@lBVl@F~CVb@DrAK|AU`@LvIbArI`AdRbCbBRFaAQhCUxESbDo@fIQpD{ApUU|BET?`@YfFGl@ANmBd@_@JBVFVl@tDFl@Ch@i@jCEf@MJc@n@_AtBgB~DeC`G}@zB_AnCi@xA{@fBm@l@mC~B_EbE{BrBuA|AsCrC_@`@q@b@i@b@gAlAQPMb@}@zA[bAIl@AbALfAh@pDNzALhBHzB@jDItCKxAQbBi@|DiAxIe@nDy@rIUpCc@lFYpCYhBSlAW`BIn@SrCY|DgAzLIrAEn@Bh@Az@GjEAxCDTCdDB`Cf@vNLdCl@vIVtCRzAb@`DDNFVx@fGZ`BNd@Xf@d@d@PJh@Pl@@PAh@Oh@_@l@}@Na@Ly@@s@Iw@Om@_@{@WWg@a@w@[m@OkAA}ANy@F_@ByAPwALgCF_CGs@EeBQaCe@wD{@eCk@sB[aCs@{F{AmDiAoHuBiBg@uBe@_C_@uBSeCMiCI{C@uBH_BNiHr@eBTcE^qAFgBAuAMoB]k@OaBo@iAm@}@k@m@c@kA_AqCsBk@[{BiAs@[qAa@yA_@}ASw@M}AKoCCsADsAJ}Ev@iC`@}ALaBDcBAk@CqFg@wD_@{Fq@yASsA[{Ac@}Ao@sC_B{FsDk@_@iAm@gC}@a@KuCg@g@GaCIs@AiFT{GTiCZ_APq@RiA^aAb@eC~@mGpCiBj@sA\cFz@oCPuCJeA?q@@aB?eDAcHScBCmAOkESg@A{G]qTq@eSi@qAAeEIsEByBF}CTmDl@k@JILmTdLSJ]D[AUO@MDe@Do@LoB\kEHMBe@VcFp@gLvAyVlAqSf@wHRyDx@uMXiFPoDnAgTnC}c@oHu@");
		$allPolyfills->add("`yleFojxsZdD\hCVLiB\iG`@oHbAqQv@sNR{DRmD@OrANvD^bJx@nLjATLPb@B\FTNXr@@lP`BjFj@bD\~RvBfLfAjJr@pGh@tG^`CPj@En@F~LbAxZlC|ZtCvLjAlBRA[BkATgEX}Gv@_NXgH?iCGaF`@sIdAiS~Ay[t@aNV{D`@mBpAyCd@cC\eJp@kTBmDE{DMkCm@cG_AaHqCkN_GoUeAiEmBoIwAqHm@mEe@kEWcFIeIFqGTqGHyCKg@B{DGkFWeD}@qEkCuFtAkBhBcDfBoDrD{HtBmFx@?rG~@n@F~AZjTlCj@?`@OHEV@JR|@TnObBnSzBtBTn@@bBHdCGhCDjCV`D\jALPNr@FfALpCZlLnAO~By@xMx@yMrAiUvBu_@xAoWxAwVrEqv@fC{a@RcDF}@v@JrFj@fD^jFl@bBRJmBPiC^_GbAoPh@uIDyAk@cFQkBHiAj@qAp@sA\mA\wEdAsRrBq^|@yOBeCR{CTcBjAwRhDmk@dCib@jB{]dE_v@lBq[dAsS|Baa@ZoF~@sNj@iL`AaQ?sAJuBNgCv@{KbBeYdE{r@v@gMl@_NKm@YQk@Ps@`@{@f@kBpBgEdDeFpDuFnBeBb@qIt@eFf@}@AkEa@gDe@gJcAaBWW@IHILOG@SUk@e@iBKIqIy@WEDeAPoFSoAKWYOqDe@eIkA}KwAsDk@qWyCyVsCcFe@i@Ia@F{AUc@Dg@f@Wh@O`ByBbUOlBO`@]dG_AxLy@dIgB`MeAbGeApFw@fGWdDYlFQzKWbHiAhScAlP[jI?nGH`FFnA`@`JBvCExDWhFq@`F}@pEuAlF[fA{AbHeAxIsAvOw@zEiArEmBdFcApBcE~GqEfGaDxD_J`LaFpFqBdB}BvAwBfAoCbAgIfBiB`@qCbA{A~@uBnBoBrCm@pAyAbFi@tEIvFj@rXH`SKrMIbKB~DVlEbAdG~A|GxAbFfBzEhGhPvAfF`AzEtAxKf@`Ij@pPHvAp@xGb@~BbA`EfBrEvBfEpHlL`GvJpBnEx@~BvAlG^lCXrDF|GQfGw@jPU`IMxMDzOTxPz@nQ|@fPXrIJrHChJY~K[jKOlECpFPnHb@rF`@zDhAdHtCvMhFbSxDtPpBtLr@dIXbI?lBG|D[bHa@tHWhEYbCoAtEa@bCs@lLuAhYi@dMg@jJq@lKa@rKc@tKq@xMrKdAdPdBrIx@bK~@rTtBrP~AvBRVAVKFVh@vCp@jDdAlFvBrKxEgB");
		$allPolyfills->add("`|weFsjxsZlAa@jAc@Ou@a@qB_@oB_AsEm@aD_@iBc@cC]cAIk@SaAuAkHu@sDG{@XiEVqFVoEt@aNr@kNp@{LH{Ab@DrGn@pJz@hIx@xBRXBAT[jFQtCQhEIzAc@xHk@|LAbAJhAZlBzAxHrAw@|@u@t@_AVe@f@gAzBiFnAgBPUv@g@j@Yz@Ut@Mv@AlE@VCXE\Mj@_@|@u@tBwBbAuAxAiBV[Dq@HqAl@yIbAoPd@cH`@_HV}DJ{CTcB@MJBx@DhANb@FNHxFh@hBPJEn@HlDb@lBVl@F~CVb@DrAK|AU`@LvIbArI`AdRbCbBRFaAQhCUxESbDo@fIQpD{ApUU|BET?`@YfFGl@ANmBd@_@JBVFVl@tDFl@Ch@i@jCEf@MJc@n@_AtBgB~DeC`G}@zB_AnCi@xA{@fBm@l@mC~B_EbE{BrBuA|AsCrC_@`@q@b@i@b@gAlAQPMb@}@zA[bAIl@AbALfAh@pDNzALhBHzB@jDItCKxAQbBi@|DiAxIe@nDy@rIUpCc@lFYpCYhBSlAW`BIn@SrCY|DgAzLIrAEn@Bh@Az@GjEAxCDTCdDB`Cf@vNLdCl@vIVtCRzAb@`DDNFVx@fGZ`BNd@Xf@d@d@PJh@Pl@@PAh@Oh@_@l@}@Na@Ly@@s@Iw@Om@_@{@WWg@a@w@[m@OkAA}ANy@F_@ByAPwALgCF_CGs@EeBQaCe@wD{@eCk@sB[aCs@{F{AmDiAoHuBiBg@uBe@_C_@uBSeCMiCI{C@uBH_BNiHr@eBTcE^qAFgBAuAMoB]k@OaBo@iAm@}@k@m@c@kA_AqCsBk@[{BiAs@[qAa@yA_@}ASw@M}AKoCCsADsAJ}Ev@iC`@}ALaBDcBAk@CqFg@wD_@{Fq@yASsA[{Ac@}Ao@sC_B{FsDk@_@iAm@gC}@a@KuCg@g@GaCIs@AiFT{GTiCZ_APq@RiA^aAb@eC~@mGpCiBj@sA\cFz@oCPuCJeA?q@@aB?eDAcHScBCmAOkESg@A{G]qTq@eSi@qAAeEIsEByBF}CTmDl@k@JILmTdLSJ]D[AUO@MDe@Do@LoB\kEHMBe@VcFp@gLvAyVlAqSf@wHRyDx@uMXiFPoDnAgTnC}c@oHu@");
		$allPolyfills->add("`yleFojxsZdD\hCVLiB\iG`@oHbAqQv@sNR{DRmD@OrANvD^bJx@vKdAVDTLPb@B\FTNXLBd@AhGl@jCRvC^|CZlANlANtALpEf@~Fj@lDb@fLfArCNvEb@pGh@tG^`CPj@En@FbE^zFb@~Fh@xRbB`MjAtFj@dE\vLjAlBRA[BkATgEX}Gv@_NXgH@wAAq@GcC?}AP_DNsDJiBNcBHcCVwEF_BNsDb@yHj@kLt@aNV{DNcAPi@pAyCT}@NeAJcBJoDDqAp@kTBmDE{DMkC]oDEQIaAOwAo@iEo@qDaByHqCaLmBmHeAiEk@}BaAqEwAqHm@mEe@kEWcFIoD?uC@{CDuBTqGHyCKg@B{DGkFIyAMkAa@eC[kASk@a@u@uAsCp@y@b@q@hBcDfBoDrD{HtBmFx@?nANbEn@n@FdALXLrM~AvEl@j@?\GBGBCDAJAJBJR?BRBh@LnObBnSzBtBTNC^Dd@D|@BdCGz@?lADjCV`D\jALPNr@FfALpCZpHt@zBXO~By@xMx@yMrAiUvBu_@TcD^yHb@qHxAwVrEqv@fC{a@RcDF}@v@JrFj@fD^jFl@bBRJmBPiC^_GbAoPh@uIBc@@u@[wCOkAIq@Gy@@e@Fc@DQd@_Ap@sA\mANuALaCRyCJiCd@oIrBq^|@yOD_AEWBm@R{CFg@FMDm@t@yLT}D~@sOhByZjAeS\cFZ_Gj@mK~@mQv@iMf@yJlAyTVaFx@gNr@iLVsEl@_MTsEl@sJx@yNZoFd@}HXuDRqFVwD`AaQE[Dw@JuBNgCv@{KbBeYdBaZh@mIt@kMv@gM^wHLgDC]GOKKMEM?]Ps@`@e@`@UDkBpBa@`@eDbCeFpDuFnBy@Vk@JiEZC@BAhE[j@KnHgCjKuHlCsCHSPQh@a@`Am@jAm@HqAv@}L`@qEb@gHr@kKbAyPl@eIZgFLaD\aKTcF~@cPjDaj@\kFN}CJqAv@{Lr@sKT}EAwAIcAmAuKwA}KeC{Tu@iGeB}NmCeTkBaOy@uG[yBwAiMIaCC{EAiM@kNC}_@?sOAoO@sEBkGEwEA{N?uLJeK@_CCgBIqAQcAq@kB_AmAgC}BqDyCsBgBuAiA_Ay@}DeDyFaEaAy@k@o@c@s@i@_BUsA]sDc@}E@oB?UHqBX_C`A{F^qBtAeGjAgG|A}HxAmI`@oA^{@d@u@t@{@pAkApCyBzCkCn@i@fCwB`A}@x@_Af@{@Vs@^wAz@{DFeAEyAMy@c@sB_@qB[{@]yAy@aDGYsAqF_GuVuF}UmDyN");

		$waypointCollection = new \Core\Event\Waypoint\Collection();
		$waypointCollection->setAllEncodedPolyfills($allPolyfills);

		/* Attendees
		 */
		$attendees = new \App\Collection();
		$attendees->add(array(
			'firstname' => 'Test Firstname',
			'lastname' => 'Test Lastname',
		));

		/* People
		 */
		$leaders = new \App\Collection();
		$leaders->add(array(
			'firstname' => 'John',
			'lastname' => 'Doe',
		));

		$this->setWaypoints($waypointCollection);
		$this->setAttendees($attendees);
		$this->setLeaders($leaders);
	}

	/* Getters/Setters
	 */

	/**
	 * Set end datetime
	 *
	 * @param string $endDateTime
	 */
	public function setEndDateTime($endDateTime) {
		$this->endDateTime = $endDateTime;
	}

	/**
	 * Get end datetime
	 *
	 * @return string
	 */
	public function getEndDateTime() {
		return $this->endDateTime;
	}

	/**
	 * Set id
	 *
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set start datetime
	 *
	 * @param string $startDateTime
	 */
	public function setStartDateTime($startDateTime) {
		$this->startDateTime = $startDateTime;
	}

	/**
	 * Get start datetime
	 *
	 * @return string
	 */
	public function getStartDateTime() {
		return $this->startDateTime;
	}

	/**
	 * Set waypoints
	 *
	 * @param null $waypoints
	 */
	public function setWaypoints($waypoints) {
		$this->waypoints = $waypoints;
	}

	/**
	 * Get waypoints
	 *
	 * @return null
	 */
	public function getWaypoints() {
		return $this->waypoints;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set attendees
	 *
	 * @param null $attendees
	 */
	public function setAttendees($attendees) {
		$this->attendees = $attendees;
	}

	/**
	 * Get attendees
	 *
	 * @return null
	 */
	public function getAttendees() {
		return $this->attendees;
	}

	/**
	 * Set leaders
	 *
	 * @param null $leaders
	 */
	public function setLeaders($leaders) {
		$this->leaders = $leaders;
	}

	/**
	 * Get leaders
	 *
	 * @return null
	 */
	public function getLeaders() {
		return $this->leaders;
	}


}