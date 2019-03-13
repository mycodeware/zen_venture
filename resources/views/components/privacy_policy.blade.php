@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>



    <!-- Start Home -->

  <section class="sub-header text-center" style="background-image:url({{url('img/terms.jpg')}})">
    
    <div class="container">
        
                    <span>COMPANY PROFILE</span>
                    <h3 class="text-capitalize">{{ __('Privacy Policy') }}</h3>
    </div>

  </section>
<section class="content_outer">
    <div class="container">
        <div class="row">
    
    <div class="">
        <p>{{ __('And Africa Co., Ltd.‏ is a private limited company incorporated under the law of Japan having its registered office at 6-11-13 Kamirenjaku, Mitaka, Tokyo, Japan. Any reference to "ZenVentures", "we", "our", "us" or “the Company”, shall include our employees, officers, directors, representatives, agents, shareholders, affiliates, subsidiaries, holding companies, related entities, advisers, sub-contractors, service providers and suppliers. We own, operate and provide certain services on the website: https://zenventures.co.za/  (the "Website").') }}</p>
        <p>{{ __('This document ("Policy") constitutes a legal agreement between you (referred to "you", "your" or "user"), as the user of the Website, and And Africa, as the owner of the Website. This Policy is only applicable to the Users of the Website, and the information and data gathered from the Users directly and not to any other information or website. You are hereby advised to read this Policy carefully and fully understand the nature and purpose of gathering and/or collecting sensitive, personal and other information and the usage, disclosure and sharing of such information.') }}</p>
        <p>{{ __('This Policy sets out the practices and policies for the protection of personal information (including sensitive personal data or information) collected, received, possessed, stored, dealt with or handled by And Africa.') }}</p>
        <p>{{ __('By using any of the ZenVentures websites you acknowledge that you have read and are bound by the following Policy, as well as any other ZenVentures’ network usage agreements that may govern your conduct.') }}</p>
    </div>
    <div class=" list-decimal-inherit">
        <ol class="list-decimal-inherit-first">
            <li>{{ __('Applicability') }}
                <ol>
                    <li>{{ __('This privacy policy (Policy) describes Our policies and procedures on the collection, use, storage and disclosure of any information including, business or personal information provided by You (You/r) while using Our platform. This Policy specifically governs,') }}
                        <ol class="list-lower-roman">
                            <li>{{ __('The collection and use of personal data and sensitive personal data or information provided by You.') }}</li>
                            <li>{{ __('The processing of personal information and sensitive personal data or information provided by You while using Our platform.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('Your use of the platform will be governed by this Policy in addition to the Terms of Use as applicable to You. The Policy together with the Terms of Use are referred to as the platform Documents.') }}
                    </li>
                    <li>{{ __('During the course of Your association with And Africa, You may be required to execute certain other commercial agreements and such commercial agreements and this Privacy Policy shall, together with the Terms of Use unless explicitly specified to the contrary, govern Your business relationship with And Africa.') }}
                    </li>
                    <li>{{ __('However, in the event of a conflict between the terms contained in the platform Documents and the terms contained in the commercial agreements, as applicable to You, the terms of the commercial agreements shall prevail unless specifically provided otherwise in the respective commercial agreement.') }}
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Definitions') }}
                <div>{{ __('Capitalized terms not otherwise defined in this Privacy Policy or the Terms of Use shall have the following meaning.') }}</div>
                <ol>
                    <li>
                        <span class="strong pr-2">{{ __('Personal Information') }}</span>
                        {{ __('shall mean any information that relates to a natural person, which, either directly or indirectly, in combination with other information available or likely to be available with an organization, is capable of identifying such person who is not otherwise publicly available. For avoidance of doubt, examples of personal information include a person‘s name, address (including work addresses and work email addresses), date of birth, voice, opinions about people, national insurance number, driving license number, permanent account number, etc.') }}
                    </li>
                    <li>
                        <span class="strong pr-2">{{ __('Sensitive Personal Data or Information') }}</span>
                        {{ __('shall mean personal information, which consists of information relating to any to the following of an individual:') }}
                        <ol class="list-lower-roman">
                            <li>{{ __('passwords ') }}</li>
                            <li>{{ __('physical, physiological and mental health condition') }}</li>
                            <li>{{ __('sexual orientation') }}</li>
                            <li>{{ __('medical records and history') }}</li>
                            <li>{{ __('biometric information (information derived from technologies that measure or analyse physical human characteristics such as voice patterns, fingerprints, facial patterns') }}</li>
                            <li>{{ __('financial information such as Bank account or credit card or debit card or other payment instrument details, etc.') }}</li>
                        </ol>
                    </li>
                    <li>
                        <span class="strong pr-2">{{ __('User Information') }}</span>
                        {{ __('shall mean, collectively, Your personal information and sensitive personal data or information or any other information collected from you.') }}
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Collective of Information') }}
                <ol>
                    <li>{{ __('And Africa will use the User Information provided by You only in accordance with the purposes described in this Policy.') }}</li>
                    <li>{{ __('In general, You can visit Our platform without revealing Your identity or any personal information. However, You may not be able to access multiple areas of the platform or features provided on the platform that require registration, subscription, or need You to reveal Your identity and/or other Personal Information or Sensitive Personal Information about You.') }}</li>
                    <li>{{ __('Minors are prohibited from using Our services and We are committed to not collecting Personal Information from any minors viewing the platform.') }}</li>
                    <li>{{ __('During Your use of Our platform, We may collect and process such information from You, including but not limited to the below mentioned:') }}
                        <ol>
                            <li>{{ __('Information that You provide to Us by filling in forms on the platform. This includes both Personal Information and Sensitive Personal Information including contact information, name, gender, email address, mailing address, phone number, financial information including bank account details, payment instrument details, details of employment and terms thereof, details of investments made by the User, if any, unique identifiers including user name, account number, password and personal preferences including favourites lists, transaction history and investment preference. At the time of creating Your Profile on the platform, You will be notified and be allowed to customize the information that is available to the public and that shall be private.') }}</li>
                            <li>{{ __('Information relating to Your business provided by you or available to the general public may be used by Us on the platform or otherwise as agreed to in the Terms of Use or such additional Service that you may have subscribed to. As a default setting, And Africa shall be creating a basic profile of Your company / business, which is available to the general public containing name, logo, sectors, twitter pitch, team, product etc. And Africa will also be creating a detailed profile from the information that You provide as well as collected from the platform, which contains all data available with And Africa relating to Your company including traction, financials, investors, timeline, competition etc. The detailed profiles can be accessed only by registered users of And Africa. You will have the option of limiting access to the information in the basic profile to the public at large as well as in restricting access to the detailed section only to registered users of And Africa approved by You.') }}</li>
                            <li>{{ __('Information that You provide when You write directly to Us (including by e-mails or letters);') }}</li>
                            <li>{{ __('Information that You provide to Us over telephone. We may make and keep a record of the information You share with Us.') }}</li>
                            <li>{{ __('Information that You provide to Us by completing surveys, feedbacks etc.') }}</li>
                            <li>{{ __('Information relating to logs is automatically reported by Your browser each time You access a web page. When You use the platform, Our servers automatically record certain information that Your web browser sends whenever You visit any website. These server logs may include information such as Your web request, Internet Protocol (IP) address, location (through GPS) browser type, referring/ exit pages and URLs, number of clicks, domain names, landing pages, pages viewed, click paths, feature usage and other such information. We use this information, which may identify users, to analyze trends, to administer the site, to track users movements around the site and to gather demographic information about the user base as a whole.') }}</li>
                            <li>{{ __('When You use the platform, We may employ clear web beacons which are used to track Your online usage patterns. In addition, We may also use clear web beacons in HTML-based e-mails sent to You to track which e-mails are opened/ viewed and which links were opened by You. Such collected information is used to enable more accurate reporting and making the platform better for Our users.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('Sensitive Personal Information:') }}
                        <ol>
                            <li>{{ __('And Africa will not collect Sensitive Personal Data or Information from You unless the collection of such sensitive personal data or information is considered necessary for the purpose for which it is being collected and even in such a case, You will be made aware of the following:') }}
                                <ol class="list-lower-alpha">
                                    <li>{{ __('The fact that Your Sensitive Personal Data or Information is being collected.') }}</li>
                                    <li>{{ __('The purpose for which the Sensitive Personal Data or Information is being collected.') }}</li>
                                    <li>{{ __('The intended recipients of the Sensitive Personal Data or Information.') }}</li>
                                </ol>
                            </li>
                            <li>{{ __('You shall have the option of not disclosing Your Sensitive Personal Data or Information to And Africa. In the event that you choose not to disclose Sensitive Personal Information, You may not be able to access multiple areas of the platform or services provided on the platform.') }}</li>
                        </ol>
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Access to User Information') }}
                <ol>
                    <li>{{ __('You shall have the right, upon request, to access and review Your Information provided to Us. You may decline to submit identifiable information through the platform, in which case You may not be allowed to access certain features / parts of the platform. If You are a registered user, You may update or correct Your account information and email preferences at any time by logging in to Your account. Alternatively, if You believe that any of Your information held by Us is inaccurate, You may write to Us at zenventures@andafrica.co.jp') }}
                        <p></p>
                        <p>{{ __('It is Your responsibility to ensure that any information You provide to Us remains accurate and updated.') }}</p>
                    </li>
                    <li>{{ __('The Information collected by Us shall not be retained for longer than is required for the purpose for which the information may lawfully be used or is otherwise required under any other law for the time being in force.') }}</li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Cookies') }}
                <ol>
                    <li>{{ __('Cookies are  files that reside on Your computer‘s hard drive and generally contain an anonymous unique identifier and are accessible only by the website that placed them there and not any other sites (Cookies).Some of Our web pages and services may also utilize Cookies and other tracking technologies to collect information about Your general internet usage.') }}
                    </li>
                    <li>{{ __('You may refuse to accept Cookies by activating the setting on Your browser which allows You to refuse the setting of Cookies. However, if You select this setting You may be unable to access certain parts of Our platform. Unless You have adjusted Your browser setting so that it will refuse Cookies, Our system may issue Cookies when You log on to the platform. The use of Cookies by Our partners, affiliates, advertisers or service providers is not covered by the Policy.') }}
                    </li>
                    <li>{{ __('Cookies enable Us to:') }}
                        <ol>
                            <li>{{ __('estimate Our users size and usage pattern.') }}</li>
                            <li>{{ __('store information about Your preferences, and allow Us to customize Our platform according to Your interests.') }}</li>
                            <li>{{ __('speed up Your searches.') }}</li>
                            <li>{{ __('recognize You when You return to Our platform.') }}</li>
                            <li>{{ __('recall Personal Information previously provided by you.') }}</li>
                            <li>{{ __('improve Our platform and deliver a better and personalized service.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('And Africa may use the services of certain third parties (also referred to as "Data Processing Partners"), for the purpose of operating and administering the platform. Such third party service providers may collect the information sent by Your browser as part of a web page request, including Cookies and your IP address and such information will be governed by the privacy policies of the third party service providers which ensure the same level of data protection, if not better, that is being adhered to by Us. We carefully evaluate each to make sure they are handling your personal data with the utmost of respect, security and privacy.') }}
                    </li>
                    <li>{{ __('As is true of most websites, we gather anonymous information automatically and store it in "Log Files". This information includes internet protocol (IP) addresses, browser type, internet service provider (ISP), referring/exit pages, operating system, date/time stamp, on-site bookmarks, on-site subscriptions, clickstream data and site navigation history.') }}
                      <p></p>
                      <p>{{ __('We use this information, which does not identify individual users, to analyze trends, to administer the site, to track users’ movements around the site and to gather information about our user base as a whole. ZenVentures may collect this non-personal information even if you are not registered on the Site.') }}</p>
                      <p>{{ __('We may link this automatically-collected data to personally identifiable information. This information is tied to personally identifiable information to provide you with feedback about your experiences on the Site and to provide you with information that you may find interesting or informative. ZenVentures may also link this information to a particular individual or combine it with personal information if ZenVentures has determined that it needs to identify a user because of safety or security issues or to comply with legal requirements.  We do not share this automatically-collected data with third parties except those that provide direct services to us to facilitate the upkeep and operation of the Site.') }}</p>
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Use of Information') }}
                <ol>
                    <li>{{ __('We may use the User Information or other information provided by You in the following ways:') }}
                        <ol>
                            <li>{{ __('monitor, improve and administer Our platform.') }}</li>
                            <li>{{ __('conduct audit, research and analysis.') }}</li>
                            <li>{{ __('analyze how the platform is used, diagnose service or technical problems, maintain security.') }}</li>
                            <li>{{ __('remember information to help You efficiently access the platform.') }}</li>
                            <li>{{ __('monitor aggregate metrics such as total number of viewers, visitors, traffic, and demographic patterns.') }}</li>
                            <li>{{ __('to confirm Your identity in order to ensure that You are eligible to Use the platform.') }}</li>
                            <li>{{ __('to ensure that content from Our platform is presented in the most effective manner based upon Your interests.') }}</li>
                            <li>{{ __('to contact You to ensure user satisfaction with respect to Your use of the platform.') }}</li>
                            <li>{{ __('to provide You with information that You request from Us, where You have consented to be contacted for such purposes.') }}</li>
                            <li>{{ __('to carry out Our obligations arising from any contracts entered into between You and Us as well as between Us and third party service providers.') }}</li>
                            <li>{{ __('to notify You about changes on Our platform.') }}</li>
                            <li>{{ __('in relation to the functioning of any feature/service you access or have signed up for in order to ensure that we can deliver such features/services to you.') }}</li>
                            <li>{{ __('in relation to any transaction entered by you on our platform to subscribe to Services.') }}</li>
                            <li>{{ __('in relation to any issued query or requested information by You from us.') }}</li>
                            <li>{{ __('to enable Us to comply with Our legal and regulatory obligations.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('Personal Information that You provide towards creation of a publicly visible profile on Our platform may be indexed by search engines (such as www.google.com and www.bing.com) and may appear in search results on such search engines.') }}
                    </li>
                    <li>{{ __('We shall notify You if We intend to use Your Personal Information or Sensitive Personal Information for any use not covered herein or in such other additional terms of use or agreement that you sign with Us. You will also be given the opportunity to withhold or withdraw Your consent for Your use other than as listed above.') }}
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Disclosure of Information') }}
                <ol>
                    <li>{{ __('Except as provided for in this Privacy Policy, We shall not disclose / transfer Your Sensitive Personal Information to any third party without Your prior consent, unless such disclosure / transfer:') }}
                        <ol class="list-lower-roman">
                            <li>{{ __('is necessary for performance of a contract between And Africa and You and You have authorized Us to share the Sensitive Personal Information.') }}</li>
                            <li>{{ __('as part of a corporate re-organisation, merger, acquisition or sale of business.') }}</li>
                            <li>{{ __('is required under applicable laws or through a court order.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('Third Party Disclosure:  We will share Your Personal Information with third parties in the manner described below:') }}
                        <ol>
                            <li>{{ __('When You place a request for services provided on the platform or otherwise by Us through third parties, We will share Your Personal Information with those parties who are required for providing the services.') }}</li>
                            <li>{{ __('We may share Your Personal Information with third parties authorized by you and in such an event, the third parties‘ use of Your information will be bound by this Policy or by their respective privacy policies which ensure the same level of data protection, if not better, that is being adhered to by Us.') }}</li>
                            <li>{{ __('We may disclose Your information to any member of Our related or group companies including Our subsidiaries, Our ultimate holding company and its subsidiaries, as the case may be.') }}</li>
                            <li>{{ __('In the event that We sell or buy any business or assets, we may disclose Your Personal Information, with Your prior consent, to the prospective seller or buyer of such business or assets. User, email, and visitor information is generally one of the transferred business assets in these types of transactions. We may also transfer or assign such information in the course of corporate divestitures, mergers, or dissolution.') }}</li>
                            <li>{{ __('We may disclose Your Personal Information to third-party service-providers, solely in the course of their provision of services to Us. We will take reasonable precautions to ensure that these service-providers are obligated to maintain the confidentiality of Your information.') }}</li>
                            <li>{{ __('We may disclose Your Personal Information, if We are under a duty to do so in order to comply with any legal obligation, or to protect our rights, property, or safety, or those of Our users, or other third parties. This includes exchanging information with other companies and organizations for the purposes of fraud protection and credit risk reduction.') }}</li>
                            <li>{{ __('We may disclose Your information, without Your prior consent, to governmental and other statutory bodies who have appropriate authorisation to access the same for any specific legal purposes.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('And Africa requires all third parties with whom it shares any Sensitive Personal Information to implement the same level of data protection that And Africa has adopted, as provided for under the IT Rules.') }}
                    </li>
                    <p></p>
                </ol>
            </li>
            <li>{{ __('Links to Third Party Sites') }}
                <ol>
                    <li>{{ __('Our Website may, from time to time, contain links to and from the websites of Our partner networks, affiliates and other third parties. The inclusion of a link does not imply any endorsement by Us of the third party website, the website’s provider, or the information on the third party website. If You follow a link to any of these websites, please note that these websites may be governed by their own privacy policies and We disclaim all responsibility or liability with respect to these policies or the websites. Please check these policies and the terms of the websites before You submit any information to these websites.') }}</li>
                    <li>{{ __('Similarly, Our Website can be made accessible through a link created by other websites. Access to Our Website through such link/s shall not mean or be deemed to mean that the objectives, aims, purposes, ideas, concepts of such other websites or their aim or purpose in establishing such link/s to Our Website is necessarily the same or similar to the idea, concept, aim or purpose of Our Website and/or Our services or that such links have been authorized by Us. We are not responsible for any representation/s of such other websites while affording such link and no liability can arise upon Us consequent to such representation, its correctness or accuracy.') }}</li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Storage and Security') }}
                <ol>
                    <li>{{ __('We endeavor to securely store all information we gather within databases controlled by Us. However, We may store information in locations outside our direct control (for instance, on servers or databases co-located with hosting providers.') }}</li>
                    <li>{{ __('Our databases are stored on servers secured behind a firewall; access to the servers is password-protected and is strictly limited. However, no method of transmission over the internet, or method of electronic storage, is 100% secure. Therefore, while We strive to use commercially acceptable means to protect Your information, We cannot guarantee its absolute security.') }}</li>
                    <li>{{ __('We use commercially reasonable safeguards to preserve the integrity and security of Your information against loss, theft, unauthorized access, disclosure, reproduction, use or amendment.') }}</li>
                    <li>{{ __('The information that We collect from You may be transferred to, and stored at, a destination inside or outside Japan. By submitting Your information on Our Platform, You agree to this transfer, storing and/ or processing. We will take such steps as we consider reasonably necessary to ensure that Your information is treated securely and in accordance with this Policy.') }}</li>
                    <li>{{ __('In using the Platform, You accept the inherent security implications of data transmission over the internet and the world wide web cannot always be guaranteed as completely secure. Therefore, Your use of the Platform will be at Your own risk.') }}</li>
                    <li>{{ __('We assume no liability for any disclosure of information due to errors in transmission, unauthorized third party access or other acts of third parties, or acts or omissions beyond Our reasonable control and You agree that You will not hold Us responsible for any breach of security.') }}</li>
                    <li>{{ __('In the event We become aware of any breach of the security of Your information, We will promptly notify You and take appropriate action to the best of Our ability to remedy such a breach.') }}</li>
                    <li>{{ __('You agree to immediately report to Us all incidents involving suspected or actual unauthorized access, disclosure, alteration, loss, damage, or destruction of data.') }}</li>
                    <li>{{ __('Any Sensitive Personal Data or Information provided on the Platform is encrypted using secure socket layer technology (SSL) while transferring such Sensitive Personal Data or Information.') }}</li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Confidentiality') }}
                <ol>
                    <li>{{ __('As a registered user with an account and a password, You are responsible for keeping Your password confidential.') }}</li>
                    <li>{{ __('We will keep confidential and protect any and all information provided by You except where disclosure is required or permitted by law.') }}</li>
                    <li>{{ __('You may obtain certain confidential information, including without limitation, information related to other users or third parties including investors and companies and technical, contractual, product, pricing, business related functions, activities and services, customer lists, knowledge of customer needs and preferences, business strategies, marketing strategies, methods of operation, markets and other valuable information in relation to such Users or third parties that should reasonably be understood as confidential (Confidential Information). You acknowledge and agree to hold all Confidential Information in strict confidence. Title and all interests to all Confidential Information shall be vested in Us.') }}</li>
                    <li>{{ __('We provide access of Personal Information to employees, agents, advisors and consultants who We believe reasonably need to come into contact with that information to provide services to You or in order to do their jobs.') }}</li>
                    <li>{{ __('We may provide information, including Personal Information, to third-party service providers to help Us deliver Our services efficiently and effectively. Service providers are also an important means by which We maintain Our Platform and mailing lists. We will take reasonable steps to ensure that these third-party service providers are obligated to protect Personal Information on Our behalf through confidentiality agreements and otherwise.') }}</li>
                    <li>{{ __('We do not intend to transfer Personal Information without Your consent to third parties who do not agree to be bound to act on Our behalf or under this Privacy Policy unless such transfer is legally required. Similarly, it is against Our policy to sell Personal Information collected online without consent.') }}</li>
                    <li>{{ __('The restrictions set out herein shall not apply to disclosure of Confidential Information if and to the extent the disclosure is:') }}
                        <ol class="list-lower-alpha">
                            <li>{{ __('required by the applicable law of any jurisdiction.') }}</li>
                            <li>{{ __('required by any applicable securities exchange, supervisory or regulatory or governmental body to which the relevant party is subject or submits, wherever situated, whether or not the requirement for disclosure has the force of law.') }}</li>
                            <li>{{ __('made, by And Africa, to its shareholders, managers, advisors and affiliates.') }}</li>
                            <li>{{ __('made to employees and representatives on a need to know basis, provided that such persons are required to treat such information as confidential through written agreement in terms which are no less strict than this Policy.') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('This Policy does not apply to any information other than such information collected by And Africa through the Platform. This Policy shall not apply to any unsolicited information You provide Us through this Platform or through any other means. This includes, but is not limited to, information posted to any public areas of the Platform. All such unsolicited information shall be deemed to be non-confidential and And Africa shall be free to use, disclose such unsolicited information without limitation.') }}</li>
                    <li>{{ __('You acknowledge and agree that any User Information you provide directly or indirectly to another User of the Platform, whether or not through the Platform, may not be subject to the same security or confidentiality offered by And Africa and that And Africa shall not have any responsibility in respect of such information under this Policy even if it was provided through the Platform.') }}</li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Indemnity') }}
                <div>{{ __('You agree to indemnify and hold And Africa harmless from:') }}</div>
                <ol class="list-lower-roman">
                    <li>{{ __('any actions, claims, demands, suits, damages, losses, penalties, interest and other charges and expenses (including legal fees and other dispute resolution costs) made by any third party due to or arising out of any violation of the terms of this Policy.') }}</li>
                    <li>{{ __('any acts or deeds, including for any non-compliance or violation, of any applicable law, rules, regulations on Your part.') }}</li>
                    <li>{{ __('for fraud committed by You.') }}</li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Severability') }}
                <p>{{ __('We have made every effort to ensure that this Policy adheres with the applicable laws. The invalidity or unenforceability of any part of this Policy shall not prejudice or affect the validity or enforceability of the remainder of this Policy.') }}</p>
            </li>
            <li>{{ __('No Waiver') }}
                <p>{{ __('The rights and remedies available under this Policy may be exercised as often as necessary and are cumulative and not exclusive of rights or remedies provided by law. It may be waived only in writing. Delay in exercising or non-exercise of any such right or remedy does not constitute a waiver of that right or remedy, or any other right or remedy.') }}
                </p>
            </li>
            <li>{{ __('Contact') }}
                <ol>
                    <li>{{ __('Please write to Us at zenventures@andafrica.co.jp to:')}}
                        <ol class="list-lower-alpha">
                            <li>{{ __('address any questions You may have about the collection, processing, usage, disclosure of Your information') }}</li>
                            <li>{{ __('request access to Your Sensitive Personal Data or Information.') }}</li>
                            <li>{{ __('report any grievances in relation to Your Sensitive Personal Data or Information.') }}</li>
                            <li>{{ __('any security breach in relation to Your Sensitive Personal Data or Information.') }}</li>
                            <li>{{ __('withdraw Your consent for usage, processing of Your information') }}</li>
                        </ol>
                    </li>
                    <li>{{ __('We may contact You using the Personal Information You have given Us:') }}
                        <ol class="list-lower-alpha">
                            <li>{{ __('in relation to the functioning of any service You have signed up for in order to ensure that We can deliver the services to You.') }}</li>
                            <li>{{ __('in relation to any transaction entered by You on Our Platform to subscribe to services.') }}</li>
                            <li>{{ __('where You have opted to receive further correspondence.') }}</li>
                            <li>{{ __('to invite You to participate in surveys, opinion polls, etc., about Our services or otherwise (participation is always voluntary).') }}</li>
                            <li>{{ __('to provide you updates and information in relation to Our services.') }}</li>
                        </ol>
                    </li>
                </ol>
                <p></p>
            </li>
            <li>{{ __('Foreign Jurisdiction') }}
                <p>{{ __('The rights and remedies available under this Policy may be exercised as often as necessary and are cumulative and not exclusive of rights or remedies provided by law. It may be waived only in writing. Delay in exercising or non-exercise of any such right or remedy does not constitute a waiver of that right or remedy, or any other right or remedy.') }}</p>
            </li>
            <li>{{ __('Changes to the Policy') }}
                <p>{{ __('We may update this Policy to reflect changes to Our practices. If We make any material changes We will notify You by e-mail (sent to the e-mail address specified in Your account) or by means of a notice on this Platform upon the change becoming effective. We encourage You to periodically review this page for the latest information on Our privacy practices. By using this Platform and Our services, you consent to the terms of this Policy and to our use and management of User Information for the purposes and in the manner herein provided.') }}</p>
            </li>
        </ol>
    </div>
   </div>
    </div>
</section>
@endsection
