﻿<VSTemplate Version="3.0.0" xmlns="http://schemas.microsoft.com/developer/vstemplate/2005" Type="Item">
    <TemplateData>
        <DefaultName>WebPage.vbhtml</DefaultName>
        <Name Package="{B54016DB-B3E6-4960-8262-81772C777DE9}" ID="21141"/>
        <Description Package="{B54016DB-B3E6-4960-8262-81772C777DE9}" ID="21143"/>
        <Icon Package="{B54016DB-B3E6-4960-8262-81772C777DE9}" ID="22003"/>
        <ProjectType>VisualBasic</ProjectType>
        <ProjectSubType>Web</ProjectSubType>
        <SortOrder>100</SortOrder>
        <RequiredFrameworkVersion>4.5</RequiredFrameworkVersion>
        <TemplateID>RazorWebPage.vbhtml.vstemplate.v3</TemplateID>
        <TemplateGroupID>Razor</TemplateGroupID>
        <NumberOfParentCategoriesToRollUp>0</NumberOfParentCategoriesToRollUp>
        <ShowByDefault>false</ShowByDefault>
    </TemplateData>
    <TemplateContent>
        <References />
        <ProjectItem SubType="" TargetFileName="$fileinputname$.vbhtml" ReplaceParameters="true">WebPage.vbhtml</ProjectItem>
    </TemplateContent>
    <WizardExtension>
        <Assembly>NuGet.VisualStudio.Interop, Version=1.0.0.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a</Assembly>
        <FullClassName>NuGet.VisualStudio.TemplateWizard</FullClassName>
    </WizardExtension>
    <WizardData>
        <packages repository="registry" keyName="WebStackVS15" isPreunzipped="true">
            <package id="Microsoft.Web.Infrastructure" version="1.0.0.0" />
            <package id="Microsoft.AspNet.Razor" version="3.2.4" />
            <package id="Microsoft.AspNet.WebPages" version="3.2.4" />
            
        </packages>
    </WizardDa