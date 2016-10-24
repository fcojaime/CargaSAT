<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" useDesign="False" needGeneration="0">
	<Components>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="Logout_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="Logout.php" forShow="True" url="Logout.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Logout" actionCategory="Security" id="2" pageRedirects="True"/>
			</Actions>
		</Event>
		<Event name="BeforeShow" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="3"/>
			</Actions>
		</Event>
	</Events>
</Page>
