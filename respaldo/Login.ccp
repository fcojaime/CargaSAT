<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\respaldo" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" masterPage="{CCS_PathToMasterPage}/MasterPage.ccp" useDesign="True" wizardTheme="None" needGeneration="0">
	<Components>
		<Panel id="7" visible="True" generateDiv="False" name="Head" contentPlaceholder="Head">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="8" visible="True" generateDiv="False" name="Content" contentPlaceholder="Content">
			<Components>
				<Record id="2" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="Login1" wizardCaption="Login" wizardOrientation="Vertical" wizardFormMethod="post" wizardRememberMe="False" wizardFocusOnLogin="False" wizardTypeComponent="Authentication" recordAddTemplatePanel="False" changedCaptionLogin="False" PathID="ContentLogin1">
					<Components>
						<Button id="3" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoLogin" wizardCaption="Login" parentName="Login1" PathID="ContentLogin1Button_DoLogin">
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
						<TextBox id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="login" fieldSource="usuario" required="True" wizardCaption="Login" wizardSize="20" wizardMaxLength="100" wizardIsPassword="False" parentName="Login1" PathID="ContentLogin1login">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="password" fieldSource="password" required="True" wizardCaption="Password" wizardSize="20" wizardMaxLength="100" wizardIsPassword="True" parentName="Login1" PathID="ContentLogin1password">
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
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="9" visible="True" generateDiv="False" name="Menu" contentPlaceholder="Menu">
			<Components>
				<IncludePage id="12" name="MenuIncludablePage" PathID="MenuMenuIncludablePage" parentType="Page" page="MenuIncludablePage.ccp">
					<Components/>
					<Events/>
					<Features/>
				</IncludePage>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="10" visible="True" generateDiv="False" name="Sidebar1" contentPlaceholder="Sidebar1">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
		<Panel id="11" visible="True" generateDiv="False" name="HeaderSidebar" contentPlaceholder="HeaderSidebar">
			<Components/>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
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
