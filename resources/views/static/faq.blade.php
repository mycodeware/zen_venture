@extends('layouts.app')

@section('content')
<div class="clearfix"></div>



    <!-- Start Home -->

<section class="sub-header text-center" style="background-image:url({{ url('img/terms.jpg') }})">
    
    <div class="container">
        
                    <span>{{ __('YOU ASK WE ANSWER') }}</span>
                    <h3 class="text-capitalize">{{ __('Frequently Asked Questions') }}</h3>
    </div>

  </section>
<section class="faq-detail">
<div class="container">
    <div class="row">

        <div class="title_bar">
            <h3 class="text-capitalize text-center">{{ __('About ZenVentures') }}</h2>
        </div>
        <div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                         <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> {{ __('When and where was ZenVentures founded?') }}  </a></h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">{{ __('ZenVentures was founded by And Africa Co., Ltd. in December 2018.  And Africa Co., Ltd. is a consultancy and investment advisory firm registered in Tokyo, Japan with a branch office in Johannesburg, South Africa.') }}</div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">{{ __('How do I contact ZenVentures?') }} </a></h4>
                 </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">{{ __('Please visit our contact page to see our office address, telephone number and online contact form.') }}</div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">{{ __('How do I partner with ZenVentures?') }} </a></h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">{{ __('Please register to our platform first, and then contact us directly via the contact page for further information about any partnerships.') }} </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingfour">
                 <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">{{ __('Does ZenVentures conduct any pitching events?') }} </a></h4>
            </div>
            <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                <div class="panel-body">{{ __('Yes, ZenVentures will be holding selective pitching events in Johannesburg, South Africa. Please contact us directly or subscribe to our platform for further information regarding the date and details of any pitching events.') }}</div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingfive">
                 <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">{{ __('Who can use the ZenVentures platform?') }} </a></h4>
            </div>
            <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                <div class="panel-body">{{ __('The ZenVentures platform can be used by anyone from companies, to entrepreneurs, to individual investors, funds, and job hunters.  Its primary role is to match Japanese and other developed country companies and investors with African startups, entrepreneurs and skilled individuals.') }}</div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingsix">
                 <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">{{ __('Which countries does ZenVentures operate in?') }} </a></h4>
            </div>
            <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                <div class="panel-body">{{ __('We currently have a physical presence in Japan and South Africa. As ZenVentures is primarily an online platform, users from any country are free to register and subscribe to the service and we intend to expand our reach to other African and developed countries to become the main bridge between African countries and developed world investors.') }}</div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingseven">
                 <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="false" aria-controls="collapseseven">{{ __('Is the ZenVentures platform free?') }} </a></h4>
            </div>
            <div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
                <div class="panel-body">{{ __('The first three months after launch will be a free trial period, after which a subscription fee will be charged to users of the platform.') }}</div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingeight">
                 <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseeight" aria-expanded="false" aria-controls="collapseeight">{{ __('Will ZenVentures invest in my company?') }}  </a></h4>
            </div>
            <div id="collapseeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingeight">
                <div class="panel-body">{{ __('No. We are not an investment firm – ZenVentures is a platform connecting Japanese and other developed country investors with African startups, entrepreneurs and skilled individuals.') }}</div>
            </div>
        </div>
        
        
        
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="title_bar">
            <h3 class="text-capitalize text-center">{{ __('For Investors') }}</h2>
        </div>
        <div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne2">
                         <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne"> {{ __('Why should I sign up for ZenVentures?') }}  </a></h4>
                    </div>
                    <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne2">
                        <div class="panel-body">{{ __('ZenVentures is the first curated platform for connecting investors in Japan with African startups and entrepreneurs. Investors can gain the following benefits from joining the ZenVentures platform:') }}
                            <ol>
                                <li>{{ __('Access to a unique and curated selection of African startups, entrepreneurs and talented individuals managed by a company with deep and extensive knowledge of both the needs of Japanese companies and investors and the capacity to identify and curate promising African startups and entrepreneurs.') }}</li>
                                <li>{{ __('A personalised matchmaking process – we can directly match investors with African startups and entrepreneurs based on sector, financing requirements, and other qualifying criteria.') }}</li>
                                <li>{{ __('Access to a database of skilled employees. We aim to mitigate the challenge of finding skilled human capital in African countries by directly matching investors and business with a database of skilled workers and university graduates.') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo2">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">{{ __('How does ZenVentures interact with investors?') }} </a></h4>
                 </div>
                    <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo2">
                        <div class="panel-body"><ol class="mt-2">
                        <li>{{ __('Registration.  The first step is for you to register to our platform. This allows you to browse our database and search for startups, entrepreneurs or individuals you are interested in.') }}</li>
                        <li>{{ __('Request contact or further information. At this point you can request to directly contact or receive more detailed information on a startup, entrepreneur or individual you are interested in.') }}</li>
                        <li>{{ __('Creating a commitment. At this stage you have two options. You can either continue private discussions separate from ZenVentures platform after the initial matchmaking, or you can request ZenVentures to conduct further due diligence mediation or matchmaking work on your behalf.') }}</li>
                    </ol></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree2">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree">{{ __('What does ZenVentures charge to investors?') }} </a></h4>
                    </div>
                    <div id="collapseThree2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree2">
                        <div class="panel-body">{{ __('Please register to our platform first, and then contact us directly via the contact page for further information about any partnerships.') }} </div>
                    </div>
                </div>
                
                
        
        
        
        
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="title_bar">
            <h3 class="text-capitalize text-center">{{ __('For Startups / Entrepreneurs / Individuals') }}</h2>
        </div>
        <div class="col-md-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne3">
                         <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne"> {{ __('Why should I sign up for ZenVentures?') }}  </a></h4>
                    </div>
                    <div id="collapseOne3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne3">
                        <div class="panel-body">{{ __('ZenVentures is the first integrated platform providing direct matching services between Japanese and other developed country investors with startups, entrepreneurs and individuals across Africa. By signing up to the platform you can expect the following benefits:') }}
                            <ol>
                                <li>{{ __('Access to a large pool of interested investors with a deep pool of capital, knowledge and technology.') }}</li>
                                <li>{{ __('A curated platform that aims to find the best match for your company or product.') }}</li>
                                <li>{{ __('The potential to find employment at major Japanese companies, either doing business in Africa or interested in hiring African employees for their Japanese operations.') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo3">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo">{{ __('How does ZenVentures support startups/entrepreneurs/individuals?') }} </a></h4>
                 </div>
                    <div id="collapseTwo3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo3">
                        <div class="panel-body">{{ __('We support startups in the following ways:') }}
                            <ol>
                                <li>{{ __('We provide access to a database of Japanese and other developed country companies and investors.') }}</li>
                                <li>{{ __('We proactively support you in your matching process, whether you are searching for investment, employment or non-financial support.') }}</li>
                                <li>{{ __('We bridge the trust and information barrier between startups, entrepreneurs and individuals in African countries, and developed country investors through our platform by providing information, communication and any required vetting to all parties using our platform.') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree3">
                         <h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree">{{ __('How do I create a good profile?') }} </a></h4>
                    </div>
                    <div id="collapseThree3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree3">
                        <div class="panel-body">{{ __('Be clear and succinct with the information on your profile.  If you are seeking funding, indicate the round of investment – Angel/Seed/Series A etc., provide a 2-3 sentence description of your company vision and product, your field of business, as well as any additional basic information about your business.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
