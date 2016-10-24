<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" useDesign="False" wizardTheme="Fresh" needGeneration="0" wizardThemeVersion="3.0">
	<Components>
		<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Login1" wizardCaption="Login" wizardOrientation="Vertical" wizardFormMethod="post" wizardRememberMe="False" wizardFocusOnLogin="False" wizardTypeComponent="Authentication" recordAddTemplatePanel="False" changedCaptionLogin="False" PathID="Login1">
			<Components>
				<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoLogin" wizardCaption="Login" parentName="Login1" PathID="Login1Button_DoLogin">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Login" actionCategory="Security" id="6" redirectToPreviousPage="True" loginParameter="login" passwordParameter="password" autoLoginParameter="autoLogin"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="login" fieldSource="usuario" required="True" wizardCaption="Login" wizardSize="20" wizardMaxLength="100" wizardIsPassword="False" parentName="Login1" PathID="Login1login">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="password" fieldSource="password" required="True" wizardCaption="Password" wizardSize="20" wizardMaxLength="100" wizardIsPassword="True" parentName="Login1" PathID="Login1password">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<IncludePage id="13" name="Header" PathID="Header" page="Header.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="Login_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="Login.php" forShow="True" url="Login.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
